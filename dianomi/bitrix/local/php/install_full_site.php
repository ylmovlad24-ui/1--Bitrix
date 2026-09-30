<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<pre>";
echo "=== Установка сайта Dianomi ===\n\n";

$docRoot = $_SERVER["DOCUMENT_ROOT"] ?? '/var/www/s277847/data/www/s277847.h1n.ru';

if (file_exists($docRoot . '/bitrix/modules/main/include/prolog_before.php')) {
    require($docRoot . '/bitrix/modules/main/include/prolog_before.php');
    echo "✅ Prolog загружен\n\n";
} else {
    echo "❌ Битрикс не найден\n";
    die();
}

use Bitrix\Main\DB\Connection;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\ElementTable;

// ============================================
// 1. Создание инфоблоков через D7 ORM
// ============================================
echo "1. Создание инфоблоков...\n";

$iblockData = array(
    "page_hero" => "Hero-блоки",
    "page_problems" => "Проблемы",
    "page_solutions" => "Решения",
    "page_before_after" => "До/После",
    "page_approach" => "Подход",
    "page_about" => "О компании",
    "page_faq" => "FAQ",
);

$createdIblocks = array();

foreach($iblockData as $code => $name) {
    $res = IblockTable::getList(array(
        'filter' => array('CODE' => $code, 'SITE_ID' => 's1'),
        'select' => array('ID'),
        'limit' => 1,
    ));
    
    $ibRow = $res->fetch();
    
    if($ibRow && $ibRow['ID']) {
        echo "⚠️ Уже существует: $name ($code) [ID: {$ibRow['ID']}]\n";
        $createdIblocks[$code] = $ibRow['ID'];
    } else {
        $ib = new IblockTable();
        $result = $ib->add(array(
            'IBLOCK_TYPE_ID' => 'content',
            'CODE' => $code,
            'NAME' => $name,
            'SITE_ID' => array('s1'),
            'SEARCHABLE' => 'Y',
            'FILTRABLE' => 'Y',
        ));
        
        if($result->isSuccess()) {
            $ibID = $result->getId();
            echo "✅ Создан: $name ($code) [ID: $ibID]\n";
            $createdIblocks[$code] = $ibID;
        } else {
            echo "❌ Ошибка: $name - " . implode(', ', $result->getErrorMessages()) . "\n";
        }
    }
}

echo "\n";

// ============================================
// 2. Создание свойств через SQL
// ============================================
echo "2. Создание свойств...\n";

$properties = array(
    "page_hero" => array(
        "BADGE_TEXT" => array("NAME" => "Текст бейджа", "TYPE" => "STRING"),
        "TITLE" => array("NAME" => "H1 заголовок", "TYPE" => "STRING"),
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "STRING"),
        "COUNTER_1" => array("NAME" => "Счётчик 1", "TYPE" => "STRING"),
        "COUNTER_2" => array("NAME" => "Счётчик 2", "TYPE" => "STRING"),
        "COUNTER_3" => array("NAME" => "Счётчик 3", "TYPE" => "STRING"),
        "COUNTER_LABEL_1" => array("NAME" => "Подпись счётчика 1", "TYPE" => "STRING"),
        "COUNTER_LABEL_2" => array("NAME" => "Подпись счётчика 2", "TYPE" => "STRING"),
        "COUNTER_LABEL_3" => array("NAME" => "Подпись счётчика 3", "TYPE" => "STRING"),
        "BENEFITS_LIST" => array("NAME" => "Список преимуществ", "TYPE" => "TEXT"),
    ),
    "page_problems" => array(
        "ICON" => array("NAME" => "Иконка", "TYPE" => "STRING"),
        "TITLE" => array("NAME" => "Заголовок", "TYPE" => "STRING"),
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "STRING"),
    ),
    "page_solutions" => array(
        "ICON" => array("NAME" => "Иконка", "TYPE" => "STRING"),
        "TITLE" => array("NAME" => "Заголовок", "TYPE" => "STRING"),
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
        "BENEFITS" => array("NAME" => "Список преимуществ", "TYPE" => "TEXT"),
        "LINK_TEXT" => array("NAME" => "Текст ссылки", "TYPE" => "STRING"),
        "LINK_URL" => array("NAME" => "URL ссылки", "TYPE" => "STRING"),
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "STRING"),
        "BORDER_COLOR" => array("NAME" => "Цвет рамки", "TYPE" => "STRING"),
    ),
    "page_before_after" => array(
        "BEFORE_TITLE" => array("NAME" => "Заголовок До", "TYPE" => "STRING"),
        "AFTER_TITLE" => array("NAME" => "Заголовок После", "TYPE" => "STRING"),
        "BEFORE_LIST" => array("NAME" => "Список До", "TYPE" => "TEXT"),
        "AFTER_LIST" => array("NAME" => "Список После", "TYPE" => "TEXT"),
    ),
    "page_approach" => array(
        "STEP_NUMBER" => array("NAME" => "Номер шага", "TYPE" => "STRING"),
        "TITLE" => array("NAME" => "Название шага", "TYPE" => "STRING"),
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "STRING"),
    ),
    "page_about" => array(
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
        "OFFICE" => array("NAME" => "Офис", "TYPE" => "STRING"),
        "FEATURES" => array("NAME" => "Преимущества", "TYPE" => "TEXT"),
    ),
    "page_faq" => array(
        "QUESTION" => array("NAME" => "Вопрос", "TYPE" => "STRING"),
        "ANSWER" => array("NAME" => "Ответ", "TYPE" => "TEXT"),
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "STRING"),
    ),
);

$dbConn = \Bitrix\Main\Application::getConnection();

foreach($properties as $ibCode => $ibProps) {
    if(!isset($createdIblocks[$ibCode])) {
        echo "⚠️ Пропуск: $ibCode\n";
        continue;
    }
    
    $ibID = $createdIblocks[$ibCode];
    $propsCreated = 0;
    
    foreach($ibProps as $propCode => $propData) {
        $typeMap = array('STRING' => 'S', 'TEXT' => 'T', 'INTEGER' => 'N');
        $propType = isset($typeMap[$propData['TYPE']]) ? $typeMap[$propData['TYPE']] : 'S';
        
        $sql = "SELECT ID FROM b_iblock_property WHERE IBLOCK_ID = " . $dbConn->containToSql($ibID) . " AND CODE = '" . $dbConn->containToSql($propCode) . "' LIMIT 1";
        $res = $dbConn->query($sql);
        
        if(!$res->fetch()) {
            $nameEscaped = str_replace("'", "''", $propData['NAME']);
            $codeEscaped = str_replace("'", "''", $propCode);
            
            $sql = "INSERT INTO b_iblock_property (IBLOCK_ID, CODE, NAME, PROPERTY_TYPE, MULTIPLE, SORT) VALUES (" . $ibID . ", '" . $codeEscaped . "', '" . $nameEscaped . "', '" . $propType . "', 'N', 500)";
            $dbConn->query($sql);
            $propsCreated++;
        }
    }
    
    echo "✅ $ibCode: $propsCreated свойств\n";
}

echo "\n";

// ============================================
// 3. Создание элементов
// ============================================
echo "3. Создание элементов...\n";

function addElement($ibID, $props, $dbConn) {
    $nameEscaped = str_replace("'", "''", (isset($props['NAME']) ? $props['NAME'] : ''));
    $codeEscaped = str_replace("'", "''", (isset($props['CODE']) ? $props['CODE'] : ''));
    
    $sql = "INSERT INTO b_iblock_element (IBLOCK_ID, CODE, NAME, ACTIVE, TIMESTAMP_X, INITIATED_BY_TIME_ZONE) VALUES (" . $ibID . ", '" . $codeEscaped . "', '" . $nameEscaped . "', 'Y', NOW(), NULL)";
    $dbConn->query($sql);
    
    $sql = "SELECT MAX(ID) AS MAX_ID FROM b_iblock_element WHERE IBLOCK_ID = " . $ibID;
    $res = $dbConn->query($sql);
    $row = $res->fetch();
    $elID = $row['MAX_ID'];
    
    foreach($props as $propCode => $propValue) {
        if($propCode === 'NAME' || $propCode === 'CODE' || $propCode === 'ACTIVE') continue;
        
        $propCodeEscaped = str_replace("'", "''", $propCode);
        $propValueEscaped = str_replace("'", "''", $propValue);
        
        $sql = "INSERT INTO b_iblock_element_property (IBLOCK_ELEMENT_ID, IBLOCK_PROPERTY_ID, VALUE_NUM, VALUE_TEXT) SELECT " . $elID . ", ID, CASE WHEN VALUE_TYPE = 'N' THEN " . $propValue . " ELSE 0 END, '" . $propValueEscaped . "' FROM b_iblock_property WHERE IBLOCK_ID = " . $ibID . " AND CODE = '" . $propCodeEscaped . "' LIMIT 1";
        $dbConn->query($sql);
    }
    
    return $elID;
}

// Hero
if(isset($createdIblocks["page_hero"])) {
    $elID = addElement($createdIblocks["page_hero"], array(
        "CODE" => "index",
        "NAME" => "Hero - index",
        "BADGE_TEXT" => "Авторизованный партнёр 1С-Битрикс",
        "TITLE" => "Битрикс24, сайт и 1С работают как <span>единая система</span> — без потерь заявок, дублирования данных и ручных отчётов",
        "DESCRIPTION" => "Запускаем Битрикс24 или сайт на 1С-Битрикс, настраиваем автоматический обмен данными с 1С.",
        "COUNTER_1" => "10",
        "COUNTER_2" => "53",
        "COUNTER_3" => "4 месяца",
        "COUNTER_LABEL_1" => "лет на рынке",
        "COUNTER_LABEL_2" => "реализованных проектов",
        "COUNTER_LABEL_3" => "окупаемость проекта",
        "BENEFITS_LIST" => json_encode(array("Заявки не теряются", "Отчёты автоматически", "Проектное управление", "Воронка под контролем")),
    ), $dbConn);
    echo "✅ Hero [ID: $elID]\n";
}

// Problems
if(isset($createdIblocks["page_problems"])) {
    $ibID = $createdIblocks["page_problems"];
    $problems = array(
        array("ICON" => "📉", "TITLE" => "Заявки с сайта теряются", "DESCRIPTION" => "менеджер не видит обращение, клиент не получает ответ.", "ORDER" => "1"),
        array("ICON" => "🔄", "TITLE" => "Данные вводятся дважды", "DESCRIPTION" => "в сайт, в CRM, в учётную систему. Ошибки неизбежны.", "ORDER" => "2"),
        array("ICON" => "🔀", "TITLE" => "Каждый источник считает по-своему", "DESCRIPTION" => "Сайт показывает одни данные, CRM — другие, 1С — третьи.", "ORDER" => "3"),
        array("ICON" => "📱", "TITLE" => "Задачи живут в Telegram и Excel", "DESCRIPTION" => "ушёл ответственный сотрудник — процесс остановился.", "ORDER" => "4"),
        array("ICON" => "📊", "TITLE" => "Выручку считаем вручную", "DESCRIPTION" => "Чтобы понять выручку, нужно собрать данные из пяти источников.", "ORDER" => "5"),
        array("ICON" => "🎯", "TITLE" => "Решения без данных", "DESCRIPTION" => "когда цифра становится очевидна — уже поздно.", "ORDER" => "6"),
    );
    
    $count = 0;
    foreach($problems as $p) {
        $elID = addElement($ibID, array(
            "NAME" => $p['TITLE'],
            "ICON" => $p['ICON'],
            "DESCRIPTION" => $p['DESCRIPTION'],
            "ORDER" => $p['ORDER'],
        ), $dbConn);
        $count++;
    }
    echo "✅ Проблем: $count\n";
}

// Solutions
if(isset($createdIblocks["page_solutions"])) {
    $ibID = $createdIblocks["page_solutions"];
    $solutions = array(
        array("ICON" => "🏢", "TITLE" => "Объединим всё в одной CRM", "DESCRIPTION" => "Битрикс24 объединит всё в одной системе.", "BENEFITS" => json_encode(array("Заявки за 2 минуты", "Отчёты автоматически", "Все данные в одном месте")), "LINK_TEXT" => "Системы управления →", "LINK_URL" => "/business-systems.php", "ORDER" => "1", "BORDER_COLOR" => "var(--primary)"),
        array("ICON" => "🌐", "TITLE" => "Сайт, который работает с бизнесом", "DESCRIPTION" => "Создаём сайт, который работает вместе с бизнесом.", "BENEFITS" => json_encode(array("Заявки в CRM", "Интеграция с 1С", "Синхронизация товаров")), "LINK_TEXT" => "Веб-системы →", "LINK_URL" => "/web-systems.php", "ORDER" => "2", "BORDER_COLOR" => "var(--accent)"),
        array("ICON" => "🔧", "TITLE" => "Наведём порядок в системе", "DESCRIPTION" => "Наведём порядок в процессах и задачах.", "BENEFITS" => json_encode(array("Прозрачные задачи", "Отчёты в реальном времени", "Без ручного ввода")), "LINK_TEXT" => "Аудит →", "LINK_URL" => "/about.php", "ORDER" => "3", "BORDER_COLOR" => "var(--success)"),
    );
    
    $count = 0;
    foreach($solutions as $s) {
        $elID = addElement($ibID, array("NAME" => $s['TITLE'], "ICON" => $s['ICON'], "DESCRIPTION" => $s['DESCRIPTION'], "BENEFITS" => $s['BENEFITS'], "LINK_TEXT" => $s['LINK_TEXT'], "LINK_URL" => $s['LINK_URL'], "ORDER" => $s['ORDER'], "BORDER_COLOR" => $s['BORDER_COLOR']), $dbConn);
        $count++;
    }
    echo "✅ Решений: $count\n";
}

// Before/After
if(isset($createdIblocks["page_before_after"])) {
    $elID = addElement($createdIblocks["page_before_after"], array(
        "NAME" => "До/После",
        "BEFORE_TITLE" => "До проекта",
        "AFTER_TITLE" => "После проекта",
        "BEFORE_LIST" => json_encode(array("Данные в разных системах", "Заявки вручную", "Отчёты в таблицах", "Задачи в сообщениях", "Нет единой картины")),
        "AFTER_LIST" => json_encode(array("Единый контур", "Заявки автоматически", "Панель руководителя", "Все задачи в системе", "Аналитика доступна")),
    ), $dbConn);
    echo "✅ До/После [ID: $elID]\n";
}

// Approach
if(isset($createdIblocks["page_approach"])) {
    $ibID = $createdIblocks["page_approach"];
    $steps = array(
        array("STEP_NUMBER" => "1", "TITLE" => "Выясняем, что болит"),
        array("STEP_NUMBER" => "2", "TITLE" => "Собираем карту процессов"),
        array("STEP_NUMBER" => "3", "TITLE" => "Рисуем целевую систему"),
        array("STEP_NUMBER" => "4", "TITLE" => "Разбиваем на этапы"),
        array("STEP_NUMBER" => "5", "TITLE" => "Реализуем и подключаем"),
        array("STEP_NUMBER" => "6", "TITLE" => "Проверяем и запускаем"),
    );
    
    $count = 0;
    foreach($steps as $s) {
        $elID = addElement($ibID, array("NAME" => $s['TITLE'], "STEP_NUMBER" => $s['STEP_NUMBER'], "ORDER" => $s['STEP_NUMBER']), $dbConn);
        $count++;
    }
    echo "✅ Шагов: $count\n";
}

// About
if(isset($createdIblocks["page_about"])) {
    $elID = addElement($createdIblocks["page_about"], array(
        "CODE" => "about",
        "NAME" => "О компании",
        "DESCRIPTION" => "Dianomi — команда архитекторов, разработчиков и внедренцев. Мы проектируем систему, в которой всё связано: сайт общается с CRM, CRM — с 1С.",
        "OFFICE" => "Офис в Барнауле. Работаем с бизнесом по всей России.",
        "FEATURES" => json_encode(array("Проектируем систему целиком", "Работаем прозрачно", "Данные вместе с процессом", "Сопровождаем после запуска")),
    ), $dbConn);
    echo "✅ О компании [ID: $elID]\n";
}

// FAQ
if(isset($createdIblocks["page_faq"])) {
    $ibID = $createdIblocks["page_faq"];
    $faqs = array(
        array("QUESTION" => "Сколько времени занимает внедрение?", "ANSWER" => "Простой запуск CRM — от 2 недель. Комплексное внедрение — от 2 месяцев."),
        array("QUESTION" => "Чем коробочный Битрикс24 отличается от облачного?", "ANSWER" => "Облачный — готовая система на серверах Битрикс24. Коробочный — на вашем сервере с полным доступом к коду."),
        array("QUESTION" => "Можно ли интегрировать 1С-Битрикс с Битрикс24?", "ANSWER" => "Да, это одна из основных задач. Настраиваем двусторонний обмен данными."),
        array("QUESTION" => "Как происходит перенос данных?", "ANSWER" => "Изучаем данные, проектируем структуру, тестируем и запускаем миграцию."),
        array("QUESTION" => "Что входит в сопровождение?", "ANSWER" => "Поддержка пользователей, контроль интеграций, исправления и развитие системы."),
    );
    
    $count = 0;
    foreach($faqs as $f) {
        $elID = addElement($ibID, array("NAME" => $f['QUESTION'], "QUESTION" => $f['QUESTION'], "ANSWER" => $f['ANSWER'], "ORDER" => ($count + 1)), $dbConn);
        $count++;
    }
    echo "✅ FAQ: $count\n";
}

echo "\n";
echo "========================================\n";
echo "✅ УСТАНОВКА ЗАВЕРШЕНА!\n";
echo "========================================\n";
echo "\nИнфоблоки:\n";
foreach($createdIblocks as $code => $id) {
    echo "  - $code [ID: $id]\n";
}
echo "\n⚠️ УДАЛИТЕ ЭТОТ ФАЙЛ!\n";
