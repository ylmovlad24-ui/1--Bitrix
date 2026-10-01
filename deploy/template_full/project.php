<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обсудить проект — Dianomi");

$APPLICATION->SetPageProperty("description", "Заполните форму, и мы свяжемся с вами. Обсудим ваш проект и предложим решение.");
$APPLICATION->SetPageProperty("og:title", "Обсудить проект — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Заполните форму, и мы свяжемся с вами. Обсудим ваш проект и предложим решение.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/project.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/project.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "index"
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
    "VARIABLE_ALIAS" => array(),
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
