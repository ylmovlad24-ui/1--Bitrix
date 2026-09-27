<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Битрикс24 — внедрение и настройка — Dianomi");

$APPLICATION->SetPageProperty("description", "Внедряем облачный и коробочный Битрикс24. Настройка CRM, бизнес-процессов, интеграция с 1С.");
$APPLICATION->SetPageProperty("keywords", "Битрикс24, внедрение, CRM, облачный, коробочный");
$APPLICATION->SetPageProperty("og:title", "Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Внедряем облачный и коробочный Битрикс24.");
$APPLICATION->SetPageProperty("og:image", "/img/og-business-systems.jpg");
?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "bitrix24",
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
        "PAGE_CODE" => "bitrix24",
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
        "PAGE_CODE" => "bitrix24",
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
        "PAGE_CODE" => "bitrix24",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
