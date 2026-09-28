<?php
// Включаем отображение ошибок для отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Загрузка Bitrix prolog...</h1>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

echo "<h1>Автоматическая установка сайта Dianomi</h1>";
echo "<p>Этот скрипт создаст все необходимые элементы сайта.</p>";
echo "<p><b>ВАЖНО: Удалите этот файл после использования!</b></p><hr>";

// ============================================
// 1. Создание инфоблоков
// ============================================
echo "<h2>1. Создание инфоблоков...</h2>";

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
foreach($iblockCodes as $code => $name) {
    $res = $ib->GetByCode($code);
    $ibID = $res ? $res->GetNext()["ID"] : false;
    
    if(!$ibID) {
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
        echo "✅ Создан инфоблок: $name ($code)<br>";
    } else {
        echo "⚠️ Инфоблок уже существует: $name ($code)<br>";
    }
}

// ============================================
// 2. Создание свойств инфоблоков
// ============================================
echo "<h2>2. Создание свойств инфоблоков...</h2>";

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
foreach($properties as $ibCode => $props) {
    $res = $ib->GetByCode($ibCode);
    $ibID = $res ? $res->GetNext()["ID"] : false;
    
    if($ibID) {
        foreach($props as $propCode => $propData) {
            $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
            if(!$propDB->Fetch()) {
                $prop->Add(array(
                    "IBLOCK_ID" => $ibID,
                    "CODE" => $propCode,
                    "NAME" => $propData["NAME"],
                    "PROPERTY_TYPE" => $propData["TYPE"] == "STRING" ? "S" : ($propData["TYPE"] == "INTEGER" ? "N" : "T"),
                    "MULTIPLE" => "N",
                ));
            }
        }
        echo "✅ Созданы свойства для: $ibCode<br>";
    }
}

// ============================================
// 3. Создание элементов инфоблоков
// ============================================
echo "<h2>3. Создание элементов инфоблоков...</h2>";

$el = new CIBlockElement();

// Hero - index
$elID = $el->Add(array(
    "IBLOCK_ID" => $ib->GetByCode("page_hero")->GetNext()["ID"],
    "ACTIVE" => "Y",
    "CODE" => "index",
    "PROPERTY_VALUES" => array(
        "BADGE_TEXT" => "Авторизованный партнёр 1С-Битрикс",
        "TITLE" => "Битрикс24, сайт и 1С работают как <span>единая система</span> — без потерь заявок, дублирования данных и ручных отчётов",
        "DESCRIPTION" => "Запускаем Битрикс24 или сайт на 1С-Битрикс, настраиваем автоматический обмен данными с 1С.",
        "COUNTER_1" => 10,
        "COUNTER_2" => 53,
        "COUNTER_3" => "4 месяца",
        "COUNTER_LABEL_1" => "лет на рынке",
        "COUNTER_LABEL_2" => "реализованных проектов",
        "COUNTER_LABEL_3" => "окупаемость проекта",
        "BENEFITS_LIST" => "
            <li style=\"display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);\">
                <span style=\"flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;\">✓</span>
                <div>
                    <p style=\"font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;\">Заявки с сайта <span style=\"color:#FFB366;\">не теряются</span></p>
                    <p style=\"font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;\">Автоматическая обработка и уведомление менеджера за 2 минуты</p>
                </div>
            </li>
            <li style=\"display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);\">
                <span style=\"flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;\">✓</span>
                <div>
                    <p style=\"font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;\">Отчёты собираются <span style=\"color:#FFB366;\">автоматически</span></p>
                    <p style=\"font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;\">Панель руководителя с данными в реальном времени</p>
                </div>
            </li>
            <li style=\"display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);\">
                <span style=\"flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;\">✓</span>
                <div>
                    <p style=\"font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;\">Внедряем <span style=\"color:#FFB366;\">проектное управление</span></p>
                    <p style=\"font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;\">Все задачи, сроки и статусы в одной системе</p>
                </div>
            </li>
            <li style=\"display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);\">
                <span style=\"flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;\">✓</span>
                <div>
                    <p style=\"font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;\">Воронка под контролем — <span style=\"color:#FFB366;\">каждый лид на учёте</span></p>
                    <p style=\"font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;\">Статусы, ответственные и сроки — видите, где застревает клиент</p>
                </div>
            </li>
        ",
    ),
));
echo "✅ Создан элемент Hero для index<br>";

// Problems
$problems = array(
    array("ICON" => "📉", "TITLE" => "Заявки с сайта теряются", "DESCRIPTION" => "менеджер не видит обращение, клиент не получает ответ. Через неделю вы узнаете, что лид ушёл к конкурентам.", "ORDER" => 1),
    array("ICON" => "🔄", "TITLE" => "Данные вводятся дважды", "DESCRIPTION" => "в сайт, в CRM, в учётную систему. Ошибки неизбежны, а на исправление уходит время.", "ORDER" => 2),
    array("ICON" => "🔀", "TITLE" => "Каждый источник считает по-своему", "DESCRIPTION" => "Сайт показывает одни остатки, CRM — другие, а учётная система — третьи.", "ORDER" => 3),
    array("ICON" => "📱", "TITLE" => "Задачи живут в Telegram и Excel", "DESCRIPTION" => "ушёл ответственный сотрудник — процесс остановился.", "ORDER" => 4),
    array("ICON" => "📊", "TITLE" => "Выручку считаем вручную", "DESCRIPTION" => "Чтобы понять выручку за месяц, нужно собрать данные из пяти источников — и подождать несколько дней.", "ORDER" => 5),
    array("ICON" => "🎯", "TITLE" => "Решения без данных", "DESCRIPTION" => "когда цифра становится очевидна — уже поздно.", "ORDER" => 6),
);

$res = $ib->GetByCode("page_problems");
$ibID = $res ? $res->GetNext()["ID"] : false;

foreach($problems as $problem) {
    $elID = $el->Add(array(
        "IBLOCK_ID" => $ibID,
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $problem,
    ));
    echo "✅ Создана проблема: {$problem['TITLE']}<br>";
}

// Solutions
$solutions = array(
    array(
        "ICON" => "🏢",
        "TITLE" => "Объединим всё в одной CRM",
        "DESCRIPTION" => "Заявки теряются, данные вводятся дважды, каждый источник считает по-своему — Битрикс24 объединит всё в одной системе.",
        "BENEFITS" => "
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Заявки за 2 минуты попадают к менеджеру</span></li>
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Отчёты собираются автоматически</span></li>
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Все данные в одном месте</span></li>
        ",
        "LINK_TEXT" => "Системы управления →",
        "LINK_URL" => "/business-systems.php",
        "ORDER" => 1,
        "BORDER_COLOR" => "var(--primary)",
    ),
    array(
        "ICON" => "🌐",
        "TITLE" => "Сайт, который работает с бизнесом",
        "DESCRIPTION" => "Сайт не связан с CRM, заявки не попадают в систему — создаём сайт, который работает вместе с бизнесом.",
        "BENEFITS" => "
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Заявки автоматически попадают в CRM</span></li>
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Интеграция с учётной системой</span></li>
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Синхронизация товаров и цен</span></li>
        ",
        "LINK_TEXT" => "Веб-системы →",
        "LINK_URL" => "/web-systems.php",
        "ORDER" => 2,
        "BORDER_COLOR" => "var(--accent)",
    ),
    array(
        "ICON" => "🔧",
        "TITLE" => "Наведём порядок в системе",
        "DESCRIPTION" => "Всё есть, но процессы тормозят, задачи живут в Telegram, а отчёты собираются вручную — наведём порядок.",
        "BENEFITS" => "
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Прозрачные процессы и задачи</span></li>
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Автоматические отчёты в реальном времени</span></li>
            <li style=\"font-size:0.875rem;color:var(--text-light);display:flex;align-items:flex-start;gap:6px;\"><span style=\"color:var(--success);flex-shrink:0;\">✓</span><span>Система работает без ручного ввода</span></li>
        ",
        "LINK_TEXT" => "Аудит и оптимизация →",
        "LINK_URL" => "/about.php",
        "ORDER" => 3,
        "BORDER_COLOR" => "var(--success)",
    ),
);

$res = $ib->GetByCode("page_solutions");
$ibID = $res ? $res->GetNext()["ID"] : false;

foreach($solutions as $solution) {
    $elID = $el->Add(array(
        "IBLOCK_ID" => $ibID,
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $solution,
    ));
    echo "✅ Создано решение: {$solution['TITLE']}<br>";
}

// Before/After
$res = $ib->GetByCode("page_before_after");
$ibID = $res ? $res->GetNext()["ID"] : false;

$elID = $el->Add(array(
    "IBLOCK_ID" => $ibID,
    "ACTIVE" => "Y",
    "PROPERTY_VALUES" => array(
        "BEFORE_TITLE" => "До проекта",
        "AFTER_TITLE" => "После проекта",
        "BEFORE_LIST" => "
            <li style=\"font-size:0.9375rem;line-height:1.6;color:var(--text-light);\">Данные находятся в разных системах</li>
            <li style=\"font-size:0.9375rem;line-height:1.6;color:var(--text-light);\">Заявки распределяются вручную</li>
            <li style=\"font-size:0.9375rem;line-height:1.6;color:var(--text-light);\">Отчёты собираются в таблицах</li>
            <li style=\"font-size:0.9375rem;line-height:1.6;color:var(--text-light);\">Задачи контролируются через сообщения</li>
            <li style=\"font-size:0.9375rem;line-height:1.6;color:var(--text-light);\">Нет единой картины бизнеса</li>
        ",
        "AFTER_LIST" => "
            <li style=\"display:flex;align-items:flex-start;gap:12px;font-size:0.9375rem;line-height:1.6;color:var(--text-dark);\"><span style=\"flex-shrink:0;width:20px;height:20px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;margin-top:1px;\">✓</span><span>Единый контур с понятными правилами обмена</span></li>
            <li style=\"display:flex;align-items:flex-start;gap:12px;font-size:0.9375rem;line-height:1.6;color:var(--text-dark);\"><span style=\"flex-shrink:0;width:20px;height:20px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;margin-top:1px;\">✓</span><span>Заявки автоматически попадают к менеджеру</span></li>
            <li style=\"display:flex;align-items:flex-start;gap:12px;font-size:0.9375rem;line-height:1.6;color:var(--text-dark);\"><span style=\"flex-shrink:0;width:20px;height:20px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;margin-top:1px;\">✓</span><span>Панель руководителя в реальном времени</span></li>
            <li style=\"display:flex;align-items:flex-start;gap:12px;font-size:0.9375rem;line-height:1.6;color:var(--text-dark);\"><span style=\"flex-shrink:0;width:20px;height:20px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;margin-top:1px;\">✓</span><span>Все задачи, сроки и статусы — в системе</span></li>
            <li style=\"display:flex;align-items:flex-start;gap:12px;font-size:0.9375rem;line-height:1.6;color:var(--text-dark);\"><span style=\"flex-shrink:0;width:20px;height:20px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;margin-top:1px;\">✓</span><span>Управленческая аналитика доступна в любой момент</span></li>
        ",
    ),
));
echo "✅ Создан элемент До/После<br>";

// Approach
$res = $ib->GetByCode("page_approach");
$ibID = $res ? $res->GetNext()["ID"] : false;

$approachSteps = array(
    array("STEP_NUMBER" => "1", "TITLE" => "Выясняем, что болит, и что считаем успешным", "ORDER" => 1),
    array("STEP_NUMBER" => "2", "TITLE" => "Собираем карту текущих процессов и систем", "ORDER" => 2),
    array("STEP_NUMBER" => "3", "TITLE" => "Рисуем, как система будет работать после", "ORDER" => 3),
    array("STEP_NUMBER" => "4", "TITLE" => "Разбиваем на этапы, чтобы видеть результат сразу", "ORDER" => 4),
    array("STEP_NUMBER" => "5", "TITLE" => "Реализуем и подключаем каждый контур", "ORDER" => 5),
    array("STEP_NUMBER" => "6", "TITLE" => "Проверяем, запускаем и остаёмся на поддержке", "ORDER" => 6),
);

foreach($approachSteps as $step) {
    $elID = $el->Add(array(
        "IBLOCK_ID" => $ibID,
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $step,
    ));
    echo "✅ Создан шаг подхода: {$step['TITLE']}<br>";
}

// About
$res = $ib->GetByCode("page_about");
$ibID = $res ? $res->GetNext()["ID"] : false;

$elID = $el->Add(array(
    "IBLOCK_ID" => $ibID,
    "ACTIVE" => "Y",
    "PROPERTY_VALUES" => array(
        "DESCRIPTION" => "Dianomi — это команда архитекторов, разработчиков и внедренцев. Мы не просто настраиваем Битрикс24 или делаем сайт — мы проектируем систему, в которой всё связано: сайт общается с CRM, CRM — с 1С, а вы видите результат в управленческой панели.",
        "OFFICE" => "Офис в Барнауле. Работаем с бизнесом по всей России.",
        "FEATURES" => "Проектируем систему целиком\nРаботаем прозрачно\nДанные вместе с процессом\nСопровождаем после запуска",
    ),
));
echo "✅ Создан элемент О компании<br>";

// FAQ
$res = $ib->GetByCode("page_faq");
$ibID = $res ? $res->GetNext()["ID"] : false;

$faqs = array(
    array("QUESTION" => "Сколько времени занимает внедрение Битрикс24?", "ANSWER" => "Простой запуск CRM — от 2 недель. Комплексное внедрение с интеграцией сайта, 1С и бизнес-процессами — от 2 месяцев. Точные сроки определяем после обследования.", "ORDER" => 1),
    array("QUESTION" => "Чем коробочный Битрикс24 отличается от облачного?", "ANSWER" => "Облачный — вы получаете готовую систему, которую настраиваем под вас. Размещается на серверах Битрикс24. Коробочный — устанавливается на ваш сервер, даёт полный доступ к коду и возможность глубокой кастомизации. Выбираем вместе, исходя из ваших задач и требований к данным.", "ORDER" => 2),
    array("QUESTION" => "Можно ли интегрировать 1С-Битрикс с Битрикс24?", "ANSWER" => "Да, это одна из основных задач. Настраиваем двусторонний обмен данными между сайтом и CRM.", "ORDER" => 3),
    array("QUESTION" => "Как происходит перенос данных из другой системы?", "ANSWER" => "Изучаем данные, проектируем структуру, тестируем на тестовом контуре и запускаем миграцию.", "ORDER" => 4),
    array("QUESTION" => "Что входит в сопровождение после запуска?", "ANSWER" => "Поддержка пользователей, контроль интеграций, исправления и плановое развитие системы.", "ORDER" => 5),
    array("QUESTION" => "Работаете ли вы с регионами?", "ANSWER" => "Да, большая часть проектов реализуется дистанционно. Офис в Барнауле, но мы регулярно работаем с клиентами из Москвы, Новосибирска, Красноярска и других городов. Онлайн-встречи, документооборот и передача данных — всё в цифре.", "ORDER" => 6),
    array("QUESTION" => "Как понять, какой формат работы нам нужен?", "ANSWER" => "На встрече обсуждаем задачу и предлагаем подходящий формат: обследование, внедрение, аудит или сопровождение.", "ORDER" => 7),
    array("QUESTION" => "Можно ли начать с аудита текущей системы?", "ANSWER" => "Да, аудит — отличный старт. Выявим проблемы и предложим поэтапный план развития.", "ORDER" => 8),
);

foreach($faqs as $faq) {
    $elID = $el->Add(array(
        "IBLOCK_ID" => $ibID,
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $faq,
    ));
    echo "✅ Создан FAQ: {$faq['QUESTION']}<br>";
}

echo "<hr>";
echo "<h2>✅ Установка завершена!</h2>";
echo "<p>Все инфоблоки, свойства и элементы созданы.</p>";
echo "<p><b>ВАЖНО: Удалите этот файл сразу после использования!</b></p>";
echo "<p><a href=\"/local/php/install_iblocks.php\" onclick=\"if(confirm('Вы уверены, что хотите удалить этот файл?')){window.location.href='delete.php?file=install_iblocks.php';return false;}\">Удалить файл</a></p>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
