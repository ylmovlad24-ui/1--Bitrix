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

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "index",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:problems", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:solutions", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:before-after", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:approach", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:about-company", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:faq", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
