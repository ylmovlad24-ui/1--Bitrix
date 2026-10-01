<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Системы управления бизнесом — Dianomi");

$APPLICATION->SetPageProperty("description", "Системы управления бизнесом на базе Битрикс24. CRM, продажи, портал, процессы.");
$APPLICATION->SetPageProperty("og:title", "Системы управления бизнесом — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Системы управления бизнесом на базе Битрикс24. CRM, продажи, портал, процессы.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/business-systems.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-business-systems.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/business-systems.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "business-systems"
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
