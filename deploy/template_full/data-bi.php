<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Данные и BI-аналитика — Dianomi");

$APPLICATION->SetPageProperty("description", "Данные, на основании которых можно управлять. BI-аналитика и управленческая отчётность.");
$APPLICATION->SetPageProperty("og:title", "Данные и BI-аналитика — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Данные, на основании которых можно управлять. BI-аналитика и управленческая отчётность.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/data-bi.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/data-bi.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "data-bi"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", "", array(
    "FORM_ACTION" => "/project.php"
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
