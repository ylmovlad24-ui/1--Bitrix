<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Веб-системы — Dianomi");
$APPLICATION->SetPageProperty("description", "Создаём сайты и веб-системы на 1С-Битрикс с интеграцией в бизнес-процессы.");
$APPLICATION->SetPageProperty("og:title", "Веб-системы — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Создаём сайты и веб-системы на 1С-Битрикс с интеграцией в бизнес-процессы.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/web-systems.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-web-systems.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/web-systems.php");
?>

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "web-systems",
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
