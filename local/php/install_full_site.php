<?php
// Включаем отображение ошибок
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<pre>";
echo "=== Установка сайта Dianomi ===\n\n";

// Подключаем Битрикс
$docRoot = $_SERVER["DOCUMENT_ROOT"] ?? '/var/www/s277847/data/www/s277847.h1n.ru';

if (file_exists($docRoot . '/bitrix/modules/main/include/prolog_before.php')) {
    require($docRoot . '/bitrix/modules/main/include/prolog_before.php');
    echo "✅ Prolog загружен\n\n";
} else {
    echo "❌ Prolog не найден по пути: $docRoot/bitrix/modules/main/include/prolog_before.php\n";
    echo "Пытаемся загрузить без prolog...\n\n";
}

// ============================================
// 1. Создание инфоблоков
// ============================================
echo "1. Создание инфоблоков...\n";

$iblockCodes = array(
    "page_hero" => "Hero-блоки",
    "page_problems" => "Проблемы",
    "page_solutions" => "Решения",
    "page_before_after" => "До/После",
    "page_approach" => "Подход",
    "page_about" => "О компании",
    "page_faq" => "FAQ",
);

$ib = new CIBlock();
$createdIblocks = array();

foreach($iblockCodes as $code => $name) {
    $res = $ib->GetByCode($code);
    $ibData = $res ? $res->GetNext() : false;
    
    if($ibData && $ibData["ID"]) {
        echo "⚠️ Уже существует: $name ($code) [ID: {$ibData['ID']}]\n";
        $createdIblocks[$code] = $ibData["ID"];
    } else {
        $ibID = $ib->Add(array(
            "IBLOCK_TYPE_ID" => "content",
            "CODE" => $code,
            "NAME" => $name,
            "SORT" => "100",
            "SITE_ID" => "s1",
            "TYPE" => "S",
            "SEARCHABLE" => "Y",
            "FILTRABLE" => "Y",
        ));
        
        if($ibID > 0) {
            echo "✅ Создан: $name ($code) [ID: $ibID]\n";
            $createdIblocks[$code] = $ibID;
        } else {
            echo "❌ Ошибка создания: $name - " . $ib->LAST_ERROR . "\n";
        }
    }
}

echo "\n";

// ============================================
// 2. Создание свойств
// ============================================
echo "2. Создание свойств...\n";

$properties = array(
    "page_hero" => array(
        "BADGE_TEXT" => array("NAME" => "Текст бейджа", "TYPE" => "STRING"),
        "TITLE" => array("NAME" => "H1 заголовок", "TYPE" => "STRING"),
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "STRING"),
        "COUNTER_1" => array("NAME" => "Счётчик 1", "TYPE" => "INTEGER"),
        "COUNTER_2" => array("NAME" => "Счётчик 2", "TYPE" => "INTEGER"),
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
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
    ),
    "page_solutions" => array(
        "ICON" => array("NAME" => "Иконка", "TYPE" => "STRING"),
        "TITLE" => array("NAME" => "Заголовок", "TYPE" => "STRING"),
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
        "BENEFITS" => array("NAME" => "Список преимуществ", "TYPE" => "TEXT"),
        "LINK_TEXT" => array("NAME" => "Текст ссылки", "TYPE" => "STRING"),
        "LINK_URL" => array("NAME" => "URL ссылки", "TYPE" => "STRING"),
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
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
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
    ),
    "page_about" => array(
        "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
        "OFFICE" => array("NAME" => "Офис", "TYPE" => "STRING"),
        "FEATURES" => array("NAME" => "Преимущества", "TYPE" => "TEXT"),
    ),
    "page_faq" => array(
        "QUESTION" => array("NAME" => "Вопрос", "TYPE" => "STRING"),
        "ANSWER" => array("NAME" => "Ответ", "TYPE" => "TEXT"),
        "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
    ),
);

$prop = new CIBlockProperty();

foreach($properties as $ibCode => $ibProps) {
    if(!isset($createdIblocks[$ibCode])) {
        echo "⚠️ Пропуск свойств для $ibCode (инфоблок не создан)\n";
        continue;
    }
    
    $ibID = $createdIblocks[$ibCode];
    $propsCreated = 0;
    
    foreach($ibProps as $propCode => $propData) {
        $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
        if(!$propDB->Fetch()) {
            $propType = ($propData["TYPE"] == "STRING") ? "S" : ($propData["TYPE"] == "INTEGER" ? "N" : "T");
            
            $propAddID = $prop->Add(array(
                "IBLOCK_ID" => $ibID,
                "CODE" => $propCode,
                "NAME" => $propData["NAME"],
                "PROPERTY_TYPE" => $propType,
                "MULTIPLE" => "N",
            ));
            
            if($propAddID > 0) {
                $propsCreated++;
            }
        }
    }
    
    echo "✅ Свойства для $ibCode: $propsCreated создано\n";
}

echo "\n";

// ============================================
// 3. Создание элементов
// ============================================
echo "3. Создание элементов...\n";

$el = new CIBlockElement();

// Hero
if(isset($createdIblocks["page_hero"])) {
    $heroProps = array(
        "BADGE_TEXT" => "Авторизованный партнёр 1С-Битрикс",
        "TITLE" => "Битрикс24, сайт и 1С работают как <span>единая система</span> — без потерь заявок, дублирования данных и ручных отчётов",
        "DESCRIPTION" => "Запускаем Битрикс24 или сайт на 1С-Битрикс, настраиваем автоматический обмен данными с 1С.",
        "COUNTER_1" => "10",
        "COUNTER_2" => "53",
        "COUNTER_3" => "4 месяца",
        "COUNTER_LABEL_1" => "лет на рынке",
        "COUNTER_LABEL_2" => "реализованных проектов",
        "COUNTER_LABEL_3" => "окупаемость проекта",
        "BENEFITS_LIST" => json_encode(array(
            "Заявки с сайта не теряются",
            "Отчёты собираются автоматически",
            "Внедряем проектное управление",
            "Воронка под контролем"
        )),
    );
    
    $elID = $el->Add(array(
        "IBLOCK_ID" => $createdIblocks["page_hero"],
        "ACTIVE" => "Y",
        "CODE" => "index",
        "PROPERTY_VALUES" => $heroProps,
    ));
    
    if($elID > 0) {
        echo "✅ Создан элемент Hero [ID: $elID]\n";
    } else {
        echo "❌ Ошибка создания Hero: " . $el->LAST_ERROR . "\n";
    }
}

// Problems
if(isset($createdIblocks["page_problems"])) {
    $problems = array(
        array("ICON" => "📉", "TITLE" => "Заявки с сайта теряются", "DESCRIPTION" => "менеджер не видит обращение, клиент не получает ответ.", "ORDER" => 1),
        array("ICON" => "🔄", "TITLE" => "Данные вводятся дважды", "DESCRIPTION" => "в сайт, в CRM, в учётную систему. Ошибки неизбежны.", "ORDER" => 2),
        array("ICON" => "🔀", "TITLE" => "Каждый источник считает по-своему", "DESCRIPTION" => "Сайт показывает одни данные, CRM — другие, 1С — третьи.", "ORDER" => 3),
        array("ICON" => "📱", "TITLE" => "Задачи живут в Telegram и Excel", "DESCRIPTION" => "ушёл ответственный сотрудник — процесс остановился.", "ORDER" => 4),
        array("ICON" => "📊", "TITLE" => "Выручку считаем вручную", "DESCRIPTION" => "Чтобы понять выручку, нужно собрать данные из пяти источников.", "ORDER" => 5),
        array("ICON" => "🎯", "TITLE" => "Решения без данных", "DESCRIPTION" => "когда цифра становится очевидна — уже поздно.", "ORDER" => 6),
    );
    
    $ibID = $createdIblocks["page_problems"];
    $count = 0;
    foreach($problems as $problem) {
        $elID = $el->Add(array(
            "IBLOCK_ID" => $ibID,
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $problem,
        ));
        if($elID > 0) $count++;
    }
    echo "✅ Создано проблем: $count\n";
}

// Solutions
if(isset($createdIblocks["page_solutions"])) {
    $solutions = array(
        array(
            "ICON" => "🏢",
            "TITLE" => "Объединим всё в одной CRM",
            "DESCRIPTION" => "Битрикс24 объединит всё в одной системе.",
            "BENEFITS" => json_encode(array("Заявки за 2 минуты", "Отчёты автоматически", "Все данные в одном месте")),
            "LINK_TEXT" => "Системы управления →",
            "LINK_URL" => "/business-systems.php",
            "ORDER" => 1,
            "BORDER_COLOR" => "var(--primary)",
        ),
        array(
            "ICON" => "🌐",
            "TITLE" => "Сайт, который работает с бизнесом",
            "DESCRIPTION" => "Создаём сайт, который работает вместе с бизнесом.",
            "BENEFITS" => json_encode(array("Заявки в CRM", "Интеграция с 1С", "Синхронизация товаров")),
            "LINK_TEXT" => "Веб-системы →",
            "LINK_URL" => "/web-systems.php",
            "ORDER" => 2,
            "BORDER_COLOR" => "var(--accent)",
        ),
        array(
            "ICON" => "🔧",
            "TITLE" => "Наведём порядок в системе",
            "DESCRIPTION" => "Наведём порядок в процессах и задачах.",
            "BENEFITS" => json_encode(array("Прозрачные задачи", "Отчёты в реальном времени", "Без ручного ввода")),
            "LINK_TEXT" => "Аудит →",
            "LINK_URL" => "/about.php",
            "ORDER" => 3,
            "BORDER_COLOR" => "var(--success)",
        ),
    );
    
    $ibID = $createdIblocks["page_solutions"];
    $count = 0;
    foreach($solutions as $solution) {
        $elID = $el->Add(array(
            "IBLOCK_ID" => $ibID,
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $solution,
        ));
        if($elID > 0) $count++;
    }
    echo "✅ Создано решений: $count\n";
}

// Before/After
if(isset($createdIblocks["page_before_after"])) {
    $elID = $el->Add(array(
        "IBLOCK_ID" => $createdIblocks["page_before_after"],
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => array(
            "BEFORE_TITLE" => "До проекта",
            "AFTER_TITLE" => "После проекта",
            "BEFORE_LIST" => json_encode(array(
                "Данные в разных системах",
                "Заявки вручную",
                "Отчёты в таблицах",
                "Задачи в сообщениях",
                "Нет единой картины"
            )),
            "AFTER_LIST" => json_encode(array(
                "Единый контур",
                "Заявки автоматически",
                "Панель руководителя",
                "Все задачи в системе",
                "Аналитика доступна"
            )),
        ),
    ));
    
    if($elID > 0) echo "✅ Создан элемент До/После [ID: $elID]\n";
}

// Approach
if(isset($createdIblocks["page_approach"])) {
    $approachSteps = array(
        array("STEP_NUMBER" => "1", "TITLE" => "Выясняем, что болит", "ORDER" => 1),
        array("STEP_NUMBER" => "2", "TITLE" => "Собираем карту процессов", "ORDER" => 2),
        array("STEP_NUMBER" => "3", "TITLE" => "Рисуем целевую систему", "ORDER" => 3),
        array("STEP_NUMBER" => "4", "TITLE" => "Разбиваем на этапы", "ORDER" => 4),
        array("STEP_NUMBER" => "5", "TITLE" => "Реализуем и подключаем", "ORDER" => 5),
        array("STEP_NUMBER" => "6", "TITLE" => "Проверяем и запускаем", "ORDER" => 6),
    );
    
    $ibID = $createdIblocks["page_approach"];
    $count = 0;
    foreach($approachSteps as $step) {
        $elID = $el->Add(array(
            "IBLOCK_ID" => $ibID,
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $step,
        ));
        if($elID > 0) $count++;
    }
    echo "✅ Создано шагов подхода: $count\n";
}

// About
if(isset($createdIblocks["page_about"])) {
    $elID = $el->Add(array(
        "IBLOCK_ID" => $createdIblocks["page_about"],
        "ACTIVE" => "Y",
        "CODE" => "about",
        "PROPERTY_VALUES" => array(
            "DESCRIPTION" => "Dianomi — команда архитекторов, разработчиков и внедренцев. Мы проектируем систему, в которой всё связано: сайт общается с CRM, CRM — с 1С.",
            "OFFICE" => "Офис в Барнауле. Работаем с бизнесом по всей России.",
            "FEATURES" => json_encode(array(
                "Проектируем систему целиком",
                "Работаем прозрачно",
                "Данные вместе с процессом",
                "Сопровождаем после запуска"
            )),
        ),
    ));
    
    if($elID > 0) echo "✅ Создан элемент О компании [ID: $elID]\n";
}

// FAQ
if(isset($createdIblocks["page_faq"])) {
    $faqs = array(
        array("QUESTION" => "Сколько времени занимает внедрение?", "ANSWER" => "Простой запуск CRM — от 2 недель. Комплексное внедрение — от 2 месяцев.", "ORDER" => 1),
        array("QUESTION" => "Чем коробочный Битрикс24 отличается от облачного?", "ANSWER" => "Облачный — готовая система на серверах Битрикс24. Коробочный — на вашем сервере с полным доступом к коду.", "ORDER" => 2),
        array("QUESTION" => "Можно ли интегрировать 1С-Битрикс с Битрикс24?", "ANSWER" => "Да, это одна из основных задач. Настраиваем двусторонний обмен данными.", "ORDER" => 3),
        array("QUESTION" => "Как происходит перенос данных?", "ANSWER" => "Изучаем данные, проектируем структуру, тестируем и запускаем миграцию.", "ORDER" => 4),
        array("QUESTION" => "Что входит в сопровождение?", "ANSWER" => "Поддержка пользователей, контроль интеграций, исправления и развитие системы.", "ORDER" => 5),
    );
    
    $ibID = $createdIblocks["page_faq"];
    $count = 0;
    foreach($faqs as $faq) {
        $elID = $el->Add(array(
            "IBLOCK_ID" => $ibID,
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $faq,
        ));
        if($elID > 0) $count++;
    }
    echo "✅ Создано элементов FAQ: $count\n";
}

echo "\n";
echo "========================================\n";
echo "✅ УСТАНОВКА ЗАВЕРШЕНА!\n";
echo "========================================\n";
echo "\nИнфоблоки созданы:\n";
foreach($createdIblocks as $code => $id) {
    echo "  - $code [ID: $id]\n";
}
echo "\n⚠️ УДАЛИТЕ ЭТОТ ФАЙЛ ПОСЛЕ ИСПОЛЬЗОВАНИЯ!\n";
