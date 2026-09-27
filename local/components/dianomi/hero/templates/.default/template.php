<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Подключение стилей
$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/hero/templates/.default/style.css">');

// Получение данных
$ob = new CIBlockElement();
$res = $ob->GetList(array(), array("IBLOCK_CODE" => "page_hero", "CODE" => $arParams["PAGE_CODE"]), false, false, array("ID", "NAME", "PROPERTY_BADGE_TEXT", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION", "PROPERTY_COUNTER_1", "PROPERTY_COUNTER_2", "PROPERTY_COUNTER_3", "PROPERTY_COUNTER_LABEL_1", "PROPERTY_COUNTER_LABEL_2", "PROPERTY_COUNTER_LABEL_3", "PROPERTY_BENEFITS_LIST"));
$arElement = $res->GetNext();
?>

<?if($arElement):?>
<section class="hero">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <div class="hero__badge animate-on-scroll">
          <svg viewBox="0 0 16 16" fill="none" width="16" height="16"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <?=$arElement["PROPERTY_BADGE_TEXT_VALUE"]?>
        </div>
        <h1 class="hero__title animate-on-scroll"><?=$arElement["PROPERTY_TITLE_VALUE"]?></h1>
        <p class="hero__desc animate-on-scroll"><?=$arElement["PROPERTY_DESCRIPTION_VALUE"]?></p>
        <div class="hero__actions animate-on-scroll">
          <a href="/contacts.php" class="btn btn-accent">Обсудить проект</a>
          <a href="#route" class="btn btn-outline">Посмотреть решения</a>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><div class="hero__stat-number" data-count="<?=$arElement["PROPERTY_COUNTER_1_VALUE"]?>">0</div><div class="hero__stat-label"><?=$arElement["PROPERTY_COUNTER_LABEL_1_VALUE"]?></div></div>
          <div class="hero-stat"><div class="hero__stat-number" data-count="<?=$arElement["PROPERTY_COUNTER_2_VALUE"]?>">0</div><div class="hero__stat-label"><?=$arElement["PROPERTY_COUNTER_LABEL_2_VALUE"]?></div></div>
          <div class="hero-stat"><div class="hero__stat-number"><?=$arElement["PROPERTY_COUNTER_3_VALUE"]?></div><div class="hero__stat-label"><?=$arElement["PROPERTY_COUNTER_LABEL_3_VALUE"]?></div></div>
        </div>
      </div>
      <div class="hero__visual animate-on-scroll">
        <div style="background:linear-gradient(135deg, #1E4474, #2A5B9A);border:1px solid rgba(42,91,154,0.6);border-radius:20px;padding:36px;box-shadow:0 8px 32px rgba(0,0,0,0.15);">
          <h3 style="font-size:1.1875rem;font-weight:700;margin:0 0 28px;color:#fff;">Что решаем вместе:</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;"><?=$arElement["PROPERTY_BENEFITS_LIST_VALUE"]?></ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?endif;?>
