<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Веб-системы — Dianomi");

$APPLICATION->SetPageProperty("description", "Веб-системы для продаж, клиентов и партнёров на базе 1С-Битрикс.");
$APPLICATION->SetPageProperty("og:title", "Веб-системы — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Веб-системы для продаж, клиентов и партнёров на базе 1С-Битрикс.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/web-systems.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-web-systems.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/web-systems.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "web-systems"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:solutions", "", array(
    "IBLOCK_ID" => "3"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:before-after", "", array(
    "IBLOCK_ID" => "4"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", "", array(
    "FORM_ACTION" => "/project.php"
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
