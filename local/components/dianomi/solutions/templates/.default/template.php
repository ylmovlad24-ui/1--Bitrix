<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/solutions/templates/.default/style.css">');

$res = CIBlockElement::GetList(array("PROPERTY_ORDER" => "ASC"), array("IBLOCK_CODE" => "page_solutions"), false, false, array("ID", "NAME", "PROPERTY_ICON", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION", "PROPERTY_BENEFITS", "PROPERTY_LINK_TEXT", "PROPERTY_LINK_URL", "PROPERTY_BORDER_COLOR"));
$solutions = array();
while ($ar = $res->GetNext()) $solutions[] = $ar;
?>

<?if($solutions):?>
<section class="section" id="route">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Какая у вас задача?</h2>
      <p class="section-heading__subtitle">Выберите направление — перейдёте к подробному описанию решений</p>
    </div>
    <div class="solutions-grid">
      <?foreach($solutions as $s):?>
      <div class="solution-card" style="border-top:4px solid <?=$s["PROPERTY_BORDER_COLOR_VALUE"]?>;">
        <div class="solution-card__icon"><?=$s["PROPERTY_ICON_VALUE"]?></div>
        <h3 class="solution-card__title"><?=$s["PROPERTY_TITLE_VALUE"]?></h3>
        <p class="solution-card__desc"><?=$s["PROPERTY_DESCRIPTION_VALUE"]?></p>
        <div class="solution-card__divider">
          <p class="solution-card__label">Что получите:</p>
          <ul class="solution-card__benefits"><?=$s["PROPERTY_BENEFITS_VALUE"]?></ul>
        </div>
        <a href="<?=$s["PROPERTY_LINK_URL_VALUE"]?>" class="solution-card__link"><?=$s["PROPERTY_LINK_TEXT_VALUE"]?></a>
      </div>
      <?endforeach;?>
    </div>
  </div>
</section>
<?endif;?>
