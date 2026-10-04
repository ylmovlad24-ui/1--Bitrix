<?php
// Включаем вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// =============================================
// Создаём тип инфоблока, если не существует
// =============================================
$rsType = CIBlockType::GetList(["=CODE" => "information_pages"]);
if (!$rsType->Fetch()) {
    CIBlockType::Add([
        "LANG" => [
            "ru" => ["NAME" => "Страницы сайта"],
        ],
        "CODE" => "information_pages",
    ]);
    echo "Создан тип инфоблока: information_pages<br>";
}

// =============================================
// Вспомогательные функции
// =============================================

function getIblockByCode($code) {
    $res = CIBlock::GetList([], ["CODE" => $code, "ACTIVE" => "Y"]);
    $row = $res->GetNext();
    return $row ? intval($row["ID"]) : 0;
}

function createIblock($code, $name, $sort = 100) {
    $ibID = getIblockByCode($code);
    if ($ibID > 0) {
        echo "Инфоблок '$code' уже существует (ID: $ibID)<br>";
        return $ibID;
    }

    $ibID = CIBlock::Add([
        "IBLOCK_TYPE_ID" => "information_pages",
        "CODE" => $code,
        "NAME" => $name,
        "ACTIVE" => "Y",
        "SORT" => $sort,
        "INDEX_ELEMENTS" => "N",
        "INDEX_SECTION" => "N",
    ]);

    if ($ibID > 0) {
        echo "Создан инфоблок '$code' (ID: $ibID)<br>";
    } else {
        $ex = $APPLICATION->GetException();
        echo "Ошибка создания инфоблока '$code': " . ($ex ? $ex->GetString() : "Неизвестная ошибка") . "<br>";
    }
    return $ibID;
}

function createProperty($ibID, $code, $name, $type = "S", $multiple = "N") {
    $res = CIBlockProperty::GetList([], ["CODE" => $code, "IBLOCK_ID" => $ibID]);
    if ($res->Fetch()) {
        return;
    }

    $propID = CIBlockProperty::Add([
        "IBLOCK_ID" => $ibID,
        "CODE" => $code,
        "NAME" => $name,
        "PROPERTY_TYPE" => $type,
        "MULTIPLE" => $multiple,
    ]);

    if ($propID > 0) {
        echo "  Создано свойство: $code<br>";
    }
}

// =============================================
// 1. HERO SECTION
// =============================================
echo "<br><b>=== 1. Hero Section ===</b><br>";
$ibHero = createIblock('page_hero', 'Hero Section');

createProperty($ibHero, 'BADGE_TEXT', 'Текст бейджа', 'S', 'N');
createProperty($ibHero, 'TITLE', 'Заголовок', 'S', 'N');
createProperty($ibHero, 'DESCRIPTION', 'Описание', 'S', 'N');
createProperty($ibHero, 'COUNTER_1', 'Счётчик 1', 'S', 'N');
createProperty($ibHero, 'COUNTER_2', 'Счётчик 2', 'S', 'N');
createProperty($ibHero, 'COUNTER_3', 'Счётчик 3', 'S', 'N');
createProperty($ibHero, 'COUNTER_LABEL_1', 'Подпись счётчика 1', 'S', 'N');
createProperty($ibHero, 'COUNTER_LABEL_2', 'Подпись счётчика 2', 'S', 'N');
createProperty($ibHero, 'COUNTER_LABEL_3', 'Подпись счётчика 3', 'S', 'N');
createProperty($ibHero, 'BENEFITS_LIST', 'Преимущества', 'S', 'Y');

// =============================================
// 2. PROBLEMS
// =============================================
echo "<br><b>=== 2. Problems ===</b><br>";
$ibProblems = createIblock('page_problems', 'Problems');

createProperty($ibProblems, 'ICON', 'Иконка', 'S', 'N');
createProperty($ibProblems, 'TITLE', 'Заголовок', 'S', 'N');
createProperty($ibProblems, 'DESCRIPTION', 'Описание', 'S', 'N');
createProperty($ibProblems, 'ORDER', 'Порядок', 'S', 'N');

// =============================================
// 3. SOLUTIONS
// =============================================
echo "<br><b>=== 3. Solutions ===</b><br>";
$ibSolutions = createIblock('page_solutions', 'Solutions');

createProperty($ibSolutions, 'ICON', 'Иконка', 'S', 'N');
createProperty($ibSolutions, 'TITLE', 'Заголовок', 'S', 'N');
createProperty($ibSolutions, 'DESCRIPTION', 'Описание', 'S', 'N');
createProperty($ibSolutions, 'BENEFITS', 'Преимущества', 'S', 'Y');
createProperty($ibSolutions, 'LINK_TEXT', 'Текст ссылки', 'S', 'N');
createProperty($ibSolutions, 'LINK_URL', 'URL ссылки', 'S', 'N');
createProperty($ibSolutions, 'BORDER_COLOR', 'Цвет рамки', 'S', 'N');
createProperty($ibSolutions, 'ORDER', 'Порядок', 'S', 'N');

// =============================================
// 4. BEFORE/AFTER
// =============================================
echo "<br><b>=== 4. Before/After ===</b><br>";
$ibBeforeAfter = createIblock('page_before_after', 'Before/After');

createProperty($ibBeforeAfter, 'BEFORE_TITLE', 'Заголовок до', 'S', 'N');
createProperty($ibBeforeAfter, 'AFTER_TITLE', 'Заголовок после', 'S', 'N');
createProperty($ibBeforeAfter, 'BEFORE_TEXT', 'Текст до', 'S', 'N');
createProperty($ibBeforeAfter, 'AFTER_TEXT', 'Текст после', 'S', 'N');

// =============================================
// 5. APPROACH
// =============================================
echo "<br><b>=== 5. Approach ===</b><br>";
$ibApproach = createIblock('page_approach', 'Approach');

createProperty($ibApproach, 'ICON', 'Иконка', 'S', 'N');
createProperty($ibApproach, 'TITLE', 'Заголовок', 'S', 'N');
createProperty($ibApproach, 'DESCRIPTION', 'Описание', 'S', 'N');
createProperty($ibApproach, 'ORDER', 'Порядок', 'S', 'N');

// =============================================
// 6. ABOUT COMPANY
// =============================================
echo "<br><b>=== 6. About Company ===</b><br>";
$ibAbout = createIblock('page_about_company', 'About Company');

createProperty($ibAbout, 'TEXT', 'Текст', 'S', 'N');

// =============================================
// 7. FAQ
// =============================================
echo "<br><b>=== 7. FAQ ===</b><br>";
$ibFaq = createIblock('page_faq', 'FAQ');

createProperty($ibFaq, 'QUESTION', 'Вопрос', 'S', 'N');
createProperty($ibFaq, 'ANSWER', 'Ответ', 'S', 'N');
createProperty($ibFaq, 'ORDER', 'Порядок', 'S', 'N');

echo "<br><b>=== Готово! ===</b><br>";
echo "Теперь зайдите в админку → Контент → Инфоблоки и заполните данные.<br>";
echo "Затем очистите кэш и обновите страницу сайта.<br>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
