<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetTitle("Системы управления бизнесом — Dianomi");?>

<?$APPLICATION->SetPageProperty("description", "Объединяем сайт, CRM и 1С в единую систему управления бизнесом.");
<?$APPLICATION->SetPageProperty("og:title", "Системы управления бизнесом — Dianomi");
<?$APPLICATION->SetPageProperty("og:description", "Объединяем сайт, CRM и 1С в единую систему управления бизнесом.");
<?$APPLICATION->SetPageProperty("og:type", "website");
<?$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/business-systems.php");
<?$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-business-systems.jpg");
<?$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/business-systems.php");?>

<!-- Hero -->
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "business-systems",
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
        "PAGE_CODE" => "business-systems",
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
        "PAGE_CODE" => "business-systems",
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
        "PAGE_CODE" => "business-systems",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
