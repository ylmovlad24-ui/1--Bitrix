<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/about-company/templates/.default/style.css">');

$res = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => "page_about"), false, false, array("ID", "NAME", "PROPERTY_DESCRIPTION", "PROPERTY_OFFICE", "PROPERTY_FEATURES"));
$ar = $res->GetNext();
?>

<?if($ar):?>
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">О Dianomi</h2>
    </div>
    <div class="about-section animate-on-scroll">
      <p class="about-section__desc"><?=$ar["PROPERTY_DESCRIPTION_VALUE"]?></p>
      <p class="about-section__desc"><?=$ar["PROPERTY_OFFICE_VALUE"]?></p>
    </div>
    <div class="about-features">
      <?foreach(explode("\n", $ar["PROPERTY_FEATURES_VALUE"]) as $f):?>
        <?if(trim($f)):?>
        <div class="about-feature animate-on-scroll"><h3 class="about-feature__title"><?=trim($f)?></h3></div>
        <?endif;?>
      <?endforeach;?>
    </div>
  </div>
</section>
<?endif;?>
