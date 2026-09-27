<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Веб-системы на 1С-Битрикс — Dianomi");

$APPLICATION->SetPageProperty("description", "Создаём сайты и веб-системы на 1С-Битрикс. Интеграция с CRM, 1С, автоматизация процессов.");
$APPLICATION->SetPageProperty("keywords", "веб-системы, 1С-Битрикс, сайт, разработка");
$APPLICATION->SetPageProperty("og:title", "Веб-системы на 1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Создаём сайты и веб-системы на 1С-Битрикс.");
$APPLICATION->SetPageProperty("og:image", "/img/og-web-systems.jpg");
?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "web-systems",
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
        "PAGE_CODE" => "web-systems",
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
        "PAGE_CODE" => "web-systems",
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
        "PAGE_CODE" => "web-systems",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
