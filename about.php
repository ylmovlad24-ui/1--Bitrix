<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании — Dianomi");
$APPLICATION->SetPageProperty("description", "Dianomi — команда архитекторов, разработчиков и внедренцев. Работаем по всей России.");
$APPLICATION->SetPageProperty("og:title", "О компании — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Dianomi — команда архитекторов, разработчиков и внедренцев. Работаем по всей России.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/about.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/about.php");
?>

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
