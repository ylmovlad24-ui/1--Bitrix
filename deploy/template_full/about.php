<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании — Dianomi");

$APPLICATION->SetPageProperty("description", "Команда архитекторов, разработчиков и внедренцев. Проектируем систему, в которой всё связано.");
$APPLICATION->SetPageProperty("og:title", "О компании — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Команда архитекторов, разработчиков и внедренцев. Проектируем систему, в которой всё связано.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/about.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/about.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "about"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:about-company", "", array(
    "IBLOCK_ID" => "6"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", "", array(
    "FORM_ACTION" => "/project.php"
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
