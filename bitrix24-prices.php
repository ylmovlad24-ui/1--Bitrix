<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Тарифы Битрикс24 — Dianomi");

$APPLICATION->SetPageProperty("description", "Тарифы Битрикс24: Бесплатный, Базовый, Стандартный, Профессиональный. Ежемесячная и ежегодная оплата со скидкой 20%.");
$APPLICATION->SetPageProperty("keywords", "тарифы Битрикс24, цена, стоимость");
$APPLICATION->SetPageProperty("og:title", "Тарифы Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Тарифы Битрикс24: от Бесплатного до Профессионального.");
$APPLICATION->SetPageProperty("og:image", "/img/og-business-systems.jpg");
?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "bitrix24-prices",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<!-- CTA -->
<?$APPLICATION->IncludeComponent(
    "dianomi:cta-form",
    ".default",
    array(
        "PAGE_CODE" => "bitrix24-prices",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
