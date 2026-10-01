<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тарифы 1С-Битрикс — Dianomi");

$APPLICATION->SetPageProperty("description", "Тарифы и редакции 1С-Битрикс. От стартовой до предпринимательской.");
$APPLICATION->SetPageProperty("og:title", "Тарифы 1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Тарифы и редакции 1С-Битрикс. От стартовой до предпринимательской.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/1c-bitrix-prices.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/1c-bitrix-prices.php");
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
