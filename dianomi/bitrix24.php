<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("description", "Внедряем облачный и коробочный Битрикс24 для автоматизации бизнес-процессов.");
$APPLICATION->SetPageProperty("og:title", "Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Внедряем облачный и коробочный Битрикс24 для автоматизации бизнес-процессов.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/bitrix24.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/bitrix24.php");
?>

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "bitrix24",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:solutions", ".default", array(
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
