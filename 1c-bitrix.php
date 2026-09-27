<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("1С-Битрикс — разработка и внедрение — Dianomi");

$APPLICATION->SetPageProperty("description", "Разработка и внедрение 1С-Битрикс. Создание сайтов, интернет-магазинов, интеграция с 1С.");
$APPLICATION->SetPageProperty("keywords", "1С-Битрикс, разработка, сайт, интернет-магазин");
$APPLICATION->SetPageProperty("og:title", "1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Разработка и внедрение 1С-Битрикс.");
$APPLICATION->SetPageProperty("og:image", "/img/og-web-systems.jpg");
?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "1c-bitrix",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<!-- Решения -->
<?$APPLICATION->IncludeComponent(
    "dianomi:solutions",
    ".default",
    array(
        "PAGE_CODE" => "1c-bitrix",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<!-- FAQ -->
<?$APPLICATION->IncludeComponent(
    "dianomi:faq",
    ".default",
    array(
        "PAGE_CODE" => "1c-bitrix",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<!-- CTA -->
<?$APPLICATION->IncludeComponent(
    "dianomi:cta-form",
    ".default",
    array(
        "PAGE_CODE" => "1c-bitrix",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
