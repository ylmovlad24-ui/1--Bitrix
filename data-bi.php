<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Данные и BI-аналитика — Dianomi");

$APPLICATION->SetPageProperty("description", "BI-аналитика и управление данными. Интеграция источников, построение отчётов, управленческая панель.");
$APPLICATION->SetPageProperty("keywords", "BI-аналитика, данные, отчёты, управленческая панель");
$APPLICATION->SetPageProperty("og:title", "Данные и BI-аналитика — Dianomi");
$APPLICATION->SetPageProperty("og:description", "BI-аналитика и управление данными.");
$APPLICATION->SetPageProperty("og:image", "/img/og-default.jpg");
?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "data-bi",
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
        "PAGE_CODE" => "data-bi",
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
        "PAGE_CODE" => "data-bi",
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
        "PAGE_CODE" => "data-bi",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
