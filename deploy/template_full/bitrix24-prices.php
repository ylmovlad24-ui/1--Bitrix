<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тарифы Битрикс24 — Dianomi");

$APPLICATION->SetPageProperty("description", "Официальные облачные тарифы и коробочная лицензия Битрикс24.");
$APPLICATION->SetPageProperty("og:title", "Тарифы Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Официальные облачные тарифы и коробочная лицензия Битрикс24.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/bitrix24-prices.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/bitrix24-prices.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "index"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", "", array(
    "FORM_ACTION" => "/project.php"
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
