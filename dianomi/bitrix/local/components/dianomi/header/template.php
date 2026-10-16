<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Dianomi Header Component
 * @package bitrix\dianomi\header
 */

$APPLICATION->IncludeRegion("dianomi.header.region");
?>
<header class="header" id="header">
  <div class="container header__inner">
    <!-- Logo -->
    <a href="/" class="header__logo">
      <img src="<?=SITE_TEMPLATE_PATH?>/img/logo-dianomi.svg" alt="dianomi" width="36" height="36">
      <span>dianomi</span>
    </a>

    <!-- Top Menu -->
    <?$APPLICATION->IncludeComponent(
      "bitrix:menu",
      "megamenu",
      array(
        "ALLOW_MULTI_SELECTION" => "N",
        "DELAY" => "N",
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "left",
        "USE_EXT" => "Y",
        "ALLOW_CUSTOMIZE_MENU" => "N",
        "ROOT_MENU" => "top",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_USE_USERS" => "Y",
      ),
      false
    );?>

    <!-- CTA Button -->
    <div class="header__cta">
      <a href="/contacts.php" class="btn btn-accent btn-sm"><?=GetMessage("HEADER_CTA_TEXT")?></a>
    </div>

    <!-- Burger -->
    <button class="burger" id="burger" aria-label="<?=GetMessage("HEADER_BURGER_LABEL")?>" aria-expanded="false">
      <span class="burger__line"></span>
      <span class="burger__line"></span>
      <span class="burger__line"></span>
    </button>
  </div>
</header>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="mobileOverlay"></div>

<!-- Mobile Menu -->
<?$APPLICATION->IncludeComponent(
  "bitrix:menu",
  "mobile",
  array(
    "ALLOW_MULTI_SELECTION" => "N",
    "DELAY" => "N",
    "MAX_LEVEL" => "2",
    "CHILD_MENU_TYPE" => "mobile",
    "USE_EXT" => "Y",
    "ALLOW_CUSTOMIZE_MENU" => "N",
    "ROOT_MENU" => "top",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_TIME" => "3600",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_USE_USERS" => "Y",
  ),
  false
);?>
