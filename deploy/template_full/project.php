<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Dianomi — Обсудить проект");
$APPLICATION->SetPageProperty("description", "Расскажите о вашей задаче — мы предложим решение.");
$APPLICATION->SetPageProperty("og:title", "Dianomi — Обсудить проект");
$APPLICATION->SetPageProperty("og:description", "Расскажите о вашей задаче — мы предложим решение.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/project.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/project.php");
?>

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "project",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("bitrix:form", "project_form", array(
    "ID" => "1",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
    "INTER" => "N",
    "IS_STICK" => "N",
    "WEB_FORM_PROCESS_ADD_FIELD" => "Y",
    "WEB_FORM_PROCESS_ADD_FILE" => "Y",
    "WEB_FORM_PROCESS_ADD_COMMENT" => "N",
    "WEB_FORM_ADD_SHOW_REQUIRED" => "Y",
    "USE_ADDITIONAL_FIELDS" => "Y",
    "USE_CAPTCHA" => "Y",
    "TEMPLATE" => "",
    "RESULT_TEMPLATE" => "",
    "CHAIN_ITEM_TEXT" => "",
    "CHAIN_ITEM_LINK" => "",
    "SUCCESS_TEXT" => "",
    "QUESTION_REQUIRED" => "Y",
), false);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
