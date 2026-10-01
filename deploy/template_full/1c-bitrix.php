<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс — Dianomi");

$APPLICATION->SetPageProperty("description", "1С-Битрикс: Управление сайтом — профессиональная CMS. Корпоративные сайты, интернет-магазины, B2B-порталы.");
$APPLICATION->SetPageProperty("og:title", "1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "1С-Битрикс: Управление сайтом — профессиональная CMS. Корпоративные сайты, интернет-магазины, B2B-порталы.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/1c-bitrix.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-web-systems.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/1c-bitrix.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "1c-bitrix"
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
