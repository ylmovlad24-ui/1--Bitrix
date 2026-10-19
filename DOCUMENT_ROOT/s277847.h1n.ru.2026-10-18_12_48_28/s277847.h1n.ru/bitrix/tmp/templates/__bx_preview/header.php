<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle($TITLE);
?>
<?$APPLICATION->IncludeRegion("dianomi.header.region");?>
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
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/style.css">
  <?$APPLICATION->ShowHead();?>
</head>
<body <?if($APPLICATION->GetVar('bx_show_admin_panel') === true):?>class="bitrix-admin-visible"<?endif;?>>
<script>
// Автоматический отступ при видимом тулбаре админки Битрикс
(function(){
  function adjustHeader(){
    var adminBar = document.querySelector('.admin-panel');
    if(adminBar && adminBar.offsetHeight > 0){
      document.body.classList.add('bitrix-admin-visible');
    } else {
      document.body.classList.remove('bitrix-admin-visible');
    }
  }
  adjustHeader();
  if(typeof BX!=='undefined' && BX.AdminPanel){
    BX.AdminPanel.subscribe('onPanelShow', adjustHeader);
    BX.AdminPanel.subscribe('onPanelHide', adjustHeader);
  }
  window.addEventListener('resize', adjustHeader);
})();
</script>
<body>
<a href="#main-content" class="sr-only" style="position:absolute;top:0;left:0;z-index:10000;padding:1rem;background:var(--primary);color:#fff;">Перейти к основному содержанию</a>

<header class="header" id="header">
  <div class="container header__inner">
    <a href="/" class="header__logo">
      <img src="<?=SITE_TEMPLATE_PATH?>/img/logo-dianomi.svg" alt="dianomi" width="36" height="36">
      <span>dianomi</span>
    </a>

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

    <div class="header__cta">
      <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
        "INCLUDE_ID" => "dianomi.header.cta",
        "INCLUDE_AREA_COMPS" => "Y",
        "TEMPLATE_STYLE" => "default",
      ), false);?>
    </div>

    <button class="burger" id="burger" aria-label="Открыть меню" aria-expanded="false">
      <span class="burger__line"></span>
      <span class="burger__line"></span>
      <span class="burger__line"></span>
    </button>
  </div>
</header>

<div class="mobile-overlay" id="mobileOverlay"></div>

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
