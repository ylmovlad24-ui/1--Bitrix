<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Тарифы 1С-Битрикс — Dianomi");

$APPLICATION->SetPageProperty("description", "Тарифы 1С-Битрикс: Старт, Малый бизнес, Бизнес, Энтерпрайз. Выбор подходящей редакции для вашего проекта.");
$APPLICATION->SetPageProperty("keywords", "тарифы 1С-Битрикс, цена, стоимость, редакция");
$APPLICATION->SetPageProperty("og:title", "Тарифы 1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Тарифы 1С-Битрикс: от Старт до Энтерпрайз.");
$APPLICATION->SetPageProperty("og:image", "/img/og-web-systems.jpg");
?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "1c-bitrix-prices",
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
        "PAGE_CODE" => "1c-bitrix-prices",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
