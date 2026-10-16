<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("description", "Внедряем 1С-Битрикс для создания корпоративных порталов и интернет-магазинов.");
$APPLICATION->SetPageProperty("og:title", "1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Внедряем 1С-Битрикс для создания корпоративных порталов и интернет-магазинов.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/1c-bitrix.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/1c-bitrix.php");
?>

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "1c-bitrix",
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
