<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle($TITLE);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$APPLICATION->getTitle()?></title>
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
  <link rel="stylesheet" href="/dianomi/css/style.css">
  <?$APPLICATION->ShowHead();?>
</head>
<body>
<a href="#main-content" class="sr-only" style="position:absolute;top:0;left:0;z-index:10000;padding:1rem;background:var(--primary);color:#fff;">Перейти к основному содержанию</a>

<header class="header" id="header">
  <div class="container header__inner">
    <a href="/" class="header__logo">
      <img src="/dianomi/img/logo-dianomi.svg" alt="dianomi" width="36" height="36">
      <span>dianomi</span>
    </a>

    <nav class="header__nav" aria-label="Основная навигация">
      <ul class="header__nav-list">
        <li><a href="/">Главная</a></li>
        <li class="has-dropdown">
          <a href="/business-systems.php">Решения</a>
          <ul class="mega-menu">
            <li><a href="/business-systems.php">Системы управления бизнесом</a></li>
            <li><a href="/bitrix24.php">Битрикс24</a></li>
            <li><a href="/bitrix24-prices.php">Тарифы Битрикс24</a></li>
            <li><a href="/web-systems.php">Веб-системы</a></li>
            <li><a href="/1c-bitrix.php">1С-Битрикс</a></li>
            <li><a href="/1c-bitrix-prices.php">Тарифы 1С-Битрикс</a></li>
            <li><a href="/data-bi.php">Данные и BI-аналитика</a></li>
          </ul>
        </li>
        <li><a href="/about.php">О компании</a></li>
        <li><a href="/contacts.php">Контакты</a></li>
      </ul>
    </nav>

    <div class="header__cta">
      <a href="/contacts.php" class="btn btn-accent btn-sm">Обсудить проект</a>
    </div>

    <button class="burger" id="burger" aria-label="Открыть меню" aria-expanded="false">
      <span class="burger__line"></span>
      <span class="burger__line"></span>
      <span class="burger__line"></span>
    </button>
  </div>
</header>

<div class="mobile-overlay" id="mobileOverlay"></div>

<nav class="mobile-menu" id="mobileMenu" aria-label="Мобильная навигация">
  <ul class="mobile-menu__list">
    <li class="mobile-menu__item"><a href="/" class="mobile-menu__link">Главная</a></li>
    
    <li class="mobile-menu__item mobile-menu__dropdown">
      <button class="mobile-menu__dropdown-btn" aria-expanded="false">
        <span>Решения</span>
        <span class="mobile-menu__dropdown-icon">&#9670;</span>
      </button>
      <ul class="mobile-menu__dropdown-list" style="display:none;">
        <li><a href="/business-systems.php">Системы управления бизнесом</a></li>
        <li><a href="/bitrix24.php">Битрикс24</a></li>
        <li><a href="/bitrix24-prices.php">Тарифы Битрикс24</a></li>
        <li><a href="/web-systems.php">Веб-системы</a></li>
        <li><a href="/1c-bitrix.php">1С-Битрикс</a></li>
        <li><a href="/1c-bitrix-prices.php">Тарифы 1С-Битрикс</a></li>
        <li><a href="/data-bi.php">Данные и BI-аналитика</a></li>
      </ul>
    </li>
    
    <li class="mobile-menu__item"><a href="/about.php" class="mobile-menu__link">О компании</a></li>
    <li class="mobile-menu__item"><a href="/contacts.php" class="mobile-menu__link">Контакты</a></li>
  </ul>
  <div class="mobile-menu__cta">
    <a href="/contacts.php" class="btn btn-accent btn-full">Обсудить проект</a>
  </div>
  <div class="mobile-menu__contacts">
    <p style="font-size:0.875rem;color:var(--text-muted);margin:12px 0 4px;">+7 (3852) 000-00-00</p>
    <p style="font-size:0.875rem;color:var(--text-muted);margin:0;">info@dianomi.ru</p>
  </div>
</nav>
