<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/approach/templates/.default/style.css">');

$res = CIBlockElement::GetList(array("PROPERTY_ORDER" => "ASC"), array("IBLOCK_CODE" => "page_approach"), false, false, array("ID", "NAME", "PROPERTY_STEP_NUMBER", "PROPERTY_TITLE"));
$steps = array();
while ($ar = $res->GetNext()) $steps[] = $ar;
?>

<?if($steps):?>
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Наш подход: от картины к деталям</h2>
    </div>
    <div class="approach-grid">
      <?foreach($steps as $s):?>
      <div class="approach-step">
        <div class="approach-step__number"><?=$s["PROPERTY_STEP_NUMBER_VALUE"]?></div>
        <h4 class="approach-step__title"><?=$s["PROPERTY_TITLE_VALUE"]?></h4>
      </div>
      <?endforeach;?>
    </div>
    <div style="text-align:center;margin-top:24px;" class="animate-on-scroll">
      <a href="/about.php" class="btn btn-outline">Как мы работаем</a>
    </div>
  </div>
</section>
<?endif;?>
