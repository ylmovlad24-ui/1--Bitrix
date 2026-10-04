<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Dianomi — Битрикс24, 1С-Битрикс, интеграции");

$APPLICATION->SetPageProperty("description", "Внедряем облачный и коробочный Битрикс24, создаём веб-системы на 1С-Битрикс, интегрируем их с 1С.");
$APPLICATION->SetPageProperty("og:title", "Dianomi — Битрикс24, 1С-Битрикс, интеграции");
$APPLICATION->SetPageProperty("og:description", "Внедряем облачный и коробочный Битрикс24, создаём веб-системы на 1С-Битрикс, интегрируем их с 1С.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "index"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:problems", "", array(
    "IBLOCK_ID" => "2"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:solutions", "", array(
    "IBLOCK_ID" => "3"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:before-after", "", array(
    "IBLOCK_ID" => "4"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:approach", "", array(
    "IBLOCK_ID" => "5"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:about-company", "", array(
    "IBLOCK_ID" => "6"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:faq", "", array(
    "IBLOCK_ID" => "7"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", "", array(
    "FORM_ACTION" => "/project.php"
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
