<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты — Dianomi");

$APPLICATION->SetPageProperty("description", "Контактная информация Dianomi. Офис в Барнауле. Работаем по всей России.");
$APPLICATION->SetPageProperty("og:title", "Контакты — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Контактная информация Dianomi. Офис в Барнауле. Работаем по всей России.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/contacts.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/contacts.php");
?>

<main id="main-content">

<?$APPLICATION->IncludeComponent("dianomi:hero", "", array(
    "PAGE_CODE" => "contacts"
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", "", array(
    "FORM_ACTION" => "/project.php"
), false);?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
