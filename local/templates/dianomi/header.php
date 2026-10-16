<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
Asset::getInstance()->addString('<link rel="preconnect" href="https://fonts.googleapis.com">');
Asset::getInstance()->addString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>');
Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">');
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialcharsbx(LANGUAGE_ID) ?>">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <meta name="description" content="<?= htmlspecialcharsbx($APPLICATION->GetPageProperty('description', 'description', '')) ?>">
    <meta property="og:title" content="<?= htmlspecialcharsbx($APPLICATION->GetPageProperty('og:title', 'og:title', '')) ?>">
    <meta property="og:description" content="<?= htmlspecialcharsbx($APPLICATION->GetPageProperty('og:description', 'og:description', '')) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialcharsbx($APPLICATION->GetPageProperty('og:url', 'og:url', '')) ?>">
    <meta property="og:image" content="<?= htmlspecialcharsbx($APPLICATION->GetPageProperty('og:image', 'og:image', '')) ?>">
    <link rel="canonical" href="<?= htmlspecialcharsbx($APPLICATION->GetPageProperty('canonical', 'canonical', '')) ?>">
</head>
<body>
    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
    
    <a href="#main-content" class="sr-only" style="position:absolute;top:0;left:0;z-index:10000;padding:1rem;background:var(--primary);color:#fff;">Перейти к основному содержанию</a>

    <header class="header" id="header">
        <div class="container header__inner">
            <a href="<?= htmlspecialcharsbx(SITE_DIR) ?>" class="header__logo">
                <img src="<?= htmlspecialcharsbx(SITE_TEMPLATE_PATH . '/images/logo-dianomi.svg') ?>" alt="dianomi" width="36" height="36">
                <span>dianomi</span>
            </a>

            <nav class="header__nav" aria-label="Основная навигация">
                <?php $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "horizontal_multilevel",
                    array(
                        "ROOT_MENU_TYPE" => "top",
                        "CHECK_INTREE" => "N",
                        "USE_EXT" => "Y",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "CHILD_MENU_TYPE" => "",
                        "MENU_ITEMS_TARGET" => "",
                        "ADD_TO_EXPANDED_MENU" => "",
                        "MENU_ON_TOP" => "N",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                    ),
                    false,
                    array("HIDE_ICONS" => "Y")
                ); ?>
            </nav>

            <div class="header__cta">
                <a href="<?= htmlspecialcharsbx(SITE_DIR . 'contacts.php') ?>" class="btn btn-accent btn-sm"><?= GetMessage("HEADER_CTA") ?></a>
            </div>

            <button class="burger" id="burger" aria-label="<?= GetMessage("HEADER_BURGER") ?>" aria-expanded="false">
                <span class="burger__line"></span>
                <span class="burger__line"></span>
                <span class="burger__line"></span>
            </button>
        </div>
    </header>

    <div class="mobile-overlay" id="mobileOverlay"></div>

    <nav class="mobile-menu" id="mobileMenu" aria-label="Мобильная навигация">
        <ul class="mobile-menu__list">
            <li class="mobile-menu__item"><a href="<?= htmlspecialcharsbx(SITE_DIR) ?>" class="mobile-menu__link"><?= GetMessage("HEADER_NAV_MAIN") ?></a></li>
            
            <li class="mobile-menu__item mobile-menu__dropdown">
                <button class="mobile-menu__dropdown-btn" aria-expanded="false">
                    <span><?= GetMessage("HEADER_NAV_SOLUTIONS") ?></span>
                    <span class="mobile-menu__dropdown-icon">&#9670;</span>
                </button>
                <ul class="mobile-menu__dropdown-list" style="display:none;">
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . 'business-systems.php') ?>">Системы управления бизнесом</a></li>
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . 'bitrix24.php') ?>">Битрикс24</a></li>
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . 'bitrix24-prices.php') ?>">Тарифы Битрикс24</a></li>
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . 'web-systems.php') ?>">Веб-системы</a></li>
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . '1c-bitrix.php') ?>">1С-Битрикс</a></li>
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . '1c-bitrix-prices.php') ?>">Тарифы 1С-Битрикс</a></li>
                    <li><a href="<?= htmlspecialcharsbx(SITE_DIR . 'data-bi.php') ?>">Данные и BI-аналитика</a></li>
                </ul>
            </li>
            
            <li class="mobile-menu__item"><a href="<?= htmlspecialcharsbx(SITE_DIR . 'about.php') ?>" class="mobile-menu__link"><?= GetMessage("HEADER_NAV_ABOUT") ?></a></li>
            <li class="mobile-menu__item"><a href="<?= htmlspecialcharsbx(SITE_DIR . 'contacts.php') ?>" class="mobile-menu__link"><?= GetMessage("HEADER_NAV_CONTACTS") ?></a></li>
        </ul>
        <div class="mobile-menu__cta">
            <a href="<?= htmlspecialcharsbx(SITE_DIR . 'contacts.php') ?>" class="btn btn-accent btn-full"><?= GetMessage("HEADER_CTA") ?></a>
        </div>
        <div class="mobile-menu__contacts">
            <p style="font-size:0.875rem;color:var(--text-muted);margin:12px 0 4px;">+7 (3852) 000-00-00</p>
            <p style="font-size:0.875rem;color:var(--text-muted);margin:0;">info@dianomi.ru</p>
        </div>
    </nav>

    <main id="main-content" class="main-content">
