<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// ============================================
// 1. Инфоблок "Hero-блоки" (page_hero)
// ============================================
$iblockCode = "page_hero";
$ib = new CIBlock();
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "Hero-блоки",
        "SORT" => "100",
        "SITE_ID" => "s1",
        "TYPE" => "S",
        "SEARCHABLE" => "Y",
        "FILTRABLE" => "Y",
    ));
}

// Свойства для page_hero
$properties = array(
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
);

foreach($properties as $propCode => $propData) {
    $prop = new CIBlockProperty();
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

// ============================================
// 2. Инфоблок "Проблемы" (page_problems)
// ============================================
$iblockCode = "page_problems";
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "Проблемы",
        "SORT" => "200",
        "SITE_ID" => "s1",
        "TYPE" => "S",
    ));
}

$propProblem = array(
    "ICON" => array("NAME" => "Иконка", "TYPE" => "STRING"),
    "TITLE" => array("NAME" => "Заголовок", "TYPE" => "STRING"),
    "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
    "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
);

foreach($propProblem as $propCode => $propData) {
    $prop = new CIBlockProperty();
    $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
    if(!$propDB->Fetch()) {
        $prop->Add(array(
            "IBLOCK_ID" => $ibID,
            "CODE" => $propCode,
            "NAME" => $propData["NAME"],
            "PROPERTY_TYPE" => $propData["TYPE"] == "STRING" ? "S" : "T",
            "MULTIPLE" => "N",
        ));
    }
}

// ============================================
// 3. Инфоблок "Решения" (page_solutions)
// ============================================
$iblockCode = "page_solutions";
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "Решения",
        "SORT" => "300",
        "SITE_ID" => "s1",
        "TYPE" => "S",
    ));
}

$propSolution = array(
    "ICON" => array("NAME" => "Иконка", "TYPE" => "STRING"),
    "TITLE" => array("NAME" => "Заголовок", "TYPE" => "STRING"),
    "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
    "BENEFITS" => array("NAME" => "Список преимуществ", "TYPE" => "TEXT"),
    "LINK_TEXT" => array("NAME" => "Текст ссылки", "TYPE" => "STRING"),
    "LINK_URL" => array("NAME" => "URL ссылки", "TYPE" => "STRING"),
    "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
    "BORDER_COLOR" => array("NAME" => "Цвет рамки", "TYPE" => "STRING"),
);

foreach($propSolution as $propCode => $propData) {
    $prop = new CIBlockProperty();
    $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
    if(!$propDB->Fetch()) {
        $prop->Add(array(
            "IBLOCK_ID" => $ibID,
            "CODE" => $propCode,
            "NAME" => $propData["NAME"],
            "PROPERTY_TYPE" => $propData["TYPE"] == "STRING" ? "S" : "T",
            "MULTIPLE" => "N",
        ));
    }
}

// ============================================
// 4. Инфоблок "До/После" (page_before_after)
// ============================================
$iblockCode = "page_before_after";
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "До/После",
        "SORT" => "400",
        "SITE_ID" => "s1",
        "TYPE" => "S",
    ));
}

$propBA = array(
    "BEFORE_TITLE" => array("NAME" => "Заголовок До", "TYPE" => "STRING"),
    "AFTER_TITLE" => array("NAME" => "Заголовок После", "TYPE" => "STRING"),
    "BEFORE_LIST" => array("NAME" => "Список До", "TYPE" => "TEXT"),
    "AFTER_LIST" => array("NAME" => "Список После", "TYPE" => "TEXT"),
);

foreach($propBA as $propCode => $propData) {
    $prop = new CIBlockProperty();
    $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
    if(!$propDB->Fetch()) {
        $prop->Add(array(
            "IBLOCK_ID" => $ibID,
            "CODE" => $propCode,
            "NAME" => $propData["NAME"],
            "PROPERTY_TYPE" => "T",
            "MULTIPLE" => "N",
        ));
    }
}

// ============================================
// 5. Инфоблок "Подход" (page_approach)
// ============================================
$iblockCode = "page_approach";
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "Подход",
        "SORT" => "500",
        "SITE_ID" => "s1",
        "TYPE" => "S",
    ));
}

$propApproach = array(
    "STEP_NUMBER" => array("NAME" => "Номер шага", "TYPE" => "STRING"),
    "TITLE" => array("NAME" => "Название шага", "TYPE" => "STRING"),
    "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
);

foreach($propApproach as $propCode => $propData) {
    $prop = new CIBlockProperty();
    $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
    if(!$propDB->Fetch()) {
        $prop->Add(array(
            "IBLOCK_ID" => $ibID,
            "CODE" => $propCode,
            "NAME" => $propData["NAME"],
            "PROPERTY_TYPE" => $propData["TYPE"] == "STRING" ? "S" : "N",
            "MULTIPLE" => "N",
        ));
    }
}

// ============================================
// 6. Инфоблок "О компании" (page_about)
// ============================================
$iblockCode = "page_about";
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "О компании",
        "SORT" => "600",
        "SITE_ID" => "s1",
        "TYPE" => "S",
    ));
}

$propAbout = array(
    "DESCRIPTION" => array("NAME" => "Описание", "TYPE" => "TEXT"),
    "OFFICE" => array("NAME" => "Офис", "TYPE" => "STRING"),
    "FEATURES" => array("NAME" => "Преимущества (каждая с новой строки)", "TYPE" => "TEXT"),
);

foreach($propAbout as $propCode => $propData) {
    $prop = new CIBlockProperty();
    $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
    if(!$propDB->Fetch()) {
        $prop->Add(array(
            "IBLOCK_ID" => $ibID,
            "CODE" => $propCode,
            "NAME" => $propData["NAME"],
            "PROPERTY_TYPE" => $propData["TYPE"] == "STRING" ? "S" : "T",
            "MULTIPLE" => "N",
        ));
    }
}

// ============================================
// 7. Инфоблок "FAQ" (page_faq)
// ============================================
$iblockCode = "page_faq";
$ibID = false;
$res = $ib->GetByCode($iblockCode);
if($res) $ibID = $res->GetNext()["ID"];

if(!$ibID) {
    $ibID = $ib->Add(array(
        "IBLOCK_TYPE_ID" => "content",
        "CODE" => $iblockCode,
        "NAME" => "FAQ",
        "SORT" => "700",
        "SITE_ID" => "s1",
        "TYPE" => "S",
    ));
}

$propFaq = array(
    "QUESTION" => array("NAME" => "Вопрос", "TYPE" => "STRING"),
    "ANSWER" => array("NAME" => "Ответ", "TYPE" => "TEXT"),
    "ORDER" => array("NAME" => "Порядок", "TYPE" => "INTEGER"),
);

foreach($propFaq as $propCode => $propData) {
    $prop = new CIBlockProperty();
    $propDB = $prop->GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $ibID));
    if(!$propDB->Fetch()) {
        $prop->Add(array(
            "IBLOCK_ID" => $ibID,
            "CODE" => $propCode,
            "NAME" => $propData["NAME"],
            "PROPERTY_TYPE" => $propData["TYPE"] == "STRING" ? "S" : "T",
            "MULTIPLE" => "N",
        ));
    }
}

echo "Инфоблоки созданы успешно!<br>";
echo "Теперь нужно заполнить их контентом через Админку: Контент → Информационные блоки<br>";
echo "<br><b>ВАЖНО: Удалите этот файл после использования!</b>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
