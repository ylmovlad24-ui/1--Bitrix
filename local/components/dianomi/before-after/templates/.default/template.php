<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/before-after/templates/.default/style.css">');

$res = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => "page_before_after"), false, false, array("ID", "NAME", "PROPERTY_BEFORE_TITLE", "PROPERTY_AFTER_TITLE", "PROPERTY_BEFORE_LIST", "PROPERTY_AFTER_LIST"));
$ar = $res->GetNext();
?>

<?if($ar):?>
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Как изменится работа после проекта</h2>
    </div>
    <div class="ba-section">
      <div class="ba-container">
        <div class="ba-column ba-column--before">
          <h3 class="ba-column__title"><?=$ar["PROPERTY_BEFORE_TITLE_VALUE"]?></h3>
          <ul class="ba-list"><?=$ar["PROPERTY_BEFORE_LIST_VALUE"]?></ul>
        </div>
        <div class="ba-divider"><div class="ba-divider__icon">→</div></div>
        <div class="ba-column ba-column--after">
          <h3 class="ba-column__title"><?=$ar["PROPERTY_AFTER_TITLE_VALUE"]?></h3>
          <ul class="ba-list"><?=$ar["PROPERTY_AFTER_LIST_VALUE"]?></ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?endif;?>
