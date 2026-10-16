<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$APPLICATION->SetTitle($TITLE);
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialcharsbx(LANGUAGE_ID) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$APPLICATION->ShowTitle()?></title>
  <meta name="description" content="<?=$APPLICATION->GetPageProperty('description','description')?>">
  <meta property="og:title" content="<?=$APPLICATION->GetPageProperty('og:title','og:title')?>">
  <meta property="og:description" content="<?=$APPLICATION->GetPageProperty('og:description','og:description')?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?=$APPLICATION->GetPageProperty('og:url','og:url')?>">
  <meta property="og:image" content="<?=$APPLICATION->GetPageProperty('og:image','og:image')?>">
  <link rel="canonical" href="<?=$APPLICATION->GetPageProperty('canonical','canonical')?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/style.css">
  <?=$APPLICATION->ShowHead()?>
  <?php
  // JSON-LD Organization schema по канону SEO
  $organizationSchema = array(
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Dianomi',
    'url' => SITE_DIR,
    'logo' => SITE_TEMPLATE_PATH . '/img/logo-dianomi.svg',
    'description' => $APPLICATION->GetPageProperty('description'),
    'contactPoint' => array(
      array(
        '@type' => 'ContactPoint',
        'telephone' => '+7-3852-000-00-00',
        'contactType' => 'customer service',
        'areaServed' => 'RU',
        'availableLanguage' => 'Russian'
      )
    ),
    'address' => array(
      '@type' => 'PostalAddress',
      'addressLocality' => 'Барнаул',
      'addressCountry' => 'RU'
    )
  );
  ?>
  <script type="application/ld+json"><?=CUtil::PhpToJSObject($organizationSchema)?></script>
</head>
<body>
<a href="#main-content" class="sr-only"><?=GetMessage("TEMPLATE_SKIP_LINK")?></a>

<header class="header" id="header">
  <div class="container header__inner">
    <a href="<?=SITE_DIR?>" class="header__logo">
      <img src="<?=SITE_TEMPLATE_PATH?>/img/logo-dianomi.svg" alt="dianomi" width="36" height="36">
      <span>dianomi</span>
    </a>

    <nav class="header__nav" aria-label="<?=GetMessage("HEADER_NAV_MAIN")?>">
      <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "megamenu",
        array(
          "ROOT_MENU_TYPE" => "top",
          "MAX_LEVEL" => "2",
          "CHILD_MENU_TYPE" => "submenu",
          "USE_EXT" => "Y",
          "MENU_CACHE_TYPE" => "A",
          "MENU_CACHE_TIME" => "3600",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "ALLOW_MULTI_SELECT" => "N",
          "CHECK_INTREE" => "N",
          "MENU_ITEMS_TARGET" => "",
          "ADD_TO_EXPANDED_MENU" => "",
          "MENU_ON_TOP" => "N",
        ),
        false
      );?>
    </nav>

    <div class="header__cta">
      <a href="<?=SITE_DIR?>contacts.php" class="btn btn-accent btn-sm"><?=GetMessage("HEADER_CTA")?></a>
    </div>

    <button class="burger" id="burger" aria-label="<?=GetMessage("HEADER_BURGER_LABEL")?>" aria-expanded="false">
      <span class="burger__line"></span>
      <span class="burger__line"></span>
      <span class="burger__line"></span>
    </button>
  </div>
</header>

<?php if ($REQUEST_URI !== '/' && $REQUEST_URI !== '/index.php'): ?>
<nav class="breadcrumbs" aria-label="<?=GetMessage("TEMPLATE_BREADCRUMBS")?>">
  <div class="container">
    <ul class="breadcrumbs__list">
      <li class="breadcrumbs__item"><a href="<?=SITE_DIR?>"><?=GetMessage("HEADER_NAV_MAIN")?></a></li>
      <?php
      $uriParts = explode('/', trim($REQUEST_URI, '/'));
      array_pop($uriParts);
      $path = '';
      foreach ($uriParts as $part) {
          $path .= '/' . $part . '/';
          $name = ucwords(str_replace(array('-', '_'), ' ', $part));
          echo '<li class="breadcrumbs__item"><a href="' . SITE_DIR . $path . '">' . htmlspecialcharsbx($name) . '</a></li>';
      }
      echo '<li class="breadcrumbs__item breadcrumbs__current">' . htmlspecialcharsbx($APPLICATION->ShowTitle()) . '</li>';
      ?>
    </ul>
  </div>
</nav>
<?php endif; ?>

<div class="mobile-overlay" id="mobileOverlay"></div>

<nav class="mobile-menu" id="mobileMenu" aria-label="<?=GetMessage("HEADER_MOBILE_NAV_SOLUTIONS")?>">
  <ul class="mobile-menu__list">
    <li class="mobile-menu__item"><a href="<?=SITE_DIR?>" class="mobile-menu__link"><?=GetMessage("HEADER_NAV_MAIN")?></a></li>
    
    <li class="mobile-menu__item mobile-menu__dropdown">
      <button class="mobile-menu__dropdown-btn" aria-expanded="false">
        <span><?=GetMessage("HEADER_MOBILE_NAV_SOLUTIONS")?></span>
        <span class="mobile-menu__dropdown-icon">▾</span>
      </button>
      <ul class="mobile-menu__dropdown-list" style="display:none;">
        <li><a href="<?=SITE_DIR?>business-systems.php">Системы управления бизнесом</a></li>
        <li><a href="<?=SITE_DIR?>bitrix24.php">Битрикс24</a></li>
        <li><a href="<?=SITE_DIR?>bitrix24-prices.php">Тарифы Битрикс24</a></li>
        <li><a href="<?=SITE_DIR?>web-systems.php">Веб-системы</a></li>
        <li><a href="<?=SITE_DIR?>1c-bitrix.php">1С-Битрикс</a></li>
        <li><a href="<?=SITE_DIR?>1c-bitrix-prices.php">Тарифы 1С-Битрикс</a></li>
        <li><a href="<?=SITE_DIR?>data-bi.php">Данные и BI-аналитика</a></li>
      </ul>
    </li>
    
    <li class="mobile-menu__item"><a href="<?=SITE_DIR?>about.php" class="mobile-menu__link"><?=GetMessage("HEADER_MOBILE_NAV_ABOUT")?></a></li>
    <li class="mobile-menu__item"><a href="<?=SITE_DIR?>contacts.php" class="mobile-menu__link"><?=GetMessage("HEADER_MOBILE_NAV_CONTACTS")?></a></li>
  </ul>
  <div class="mobile-menu__cta">
    <a href="<?=SITE_DIR?>contacts.php" class="btn btn-accent btn-full"><?=GetMessage("HEADER_MOBILE_CTA")?></a>
  </div>
  <div class="mobile-menu__contacts">
    <p style="font-size:0.875rem;color:var(--text-muted);margin:12px 0 4px;"><?=GetMessage("HEADER_MOBILE_PHONE")?></p>
    <p style="font-size:0.875rem;color:var(--text-muted);margin:0;"><?=GetMessage("HEADER_MOBILE_EMAIL")?></p>
  </div>
</nav>

<?=$APPLICATION->ShowPanel()?>
