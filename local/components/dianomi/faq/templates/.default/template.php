<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/faq/templates/.default/style.css">');

$res = CIBlockElement::GetList(array("PROPERTY_ORDER" => "ASC"), array("IBLOCK_CODE" => "page_faq"), false, false, array("ID", "NAME", "PROPERTY_QUESTION", "PROPERTY_ANSWER"));
$faqs = array();
while ($ar = $res->GetNext()) $faqs[] = $ar;
?>

<?if($faqs):?>
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Частые вопросы</h2>
    </div>
    <div class="faq-list animate-on-scroll">
      <?foreach($faqs as $f):?>
      <div class="faq-item">
        <button class="faq-question"><span><?=$f["PROPERTY_QUESTION_VALUE"]?></span><span class="faq-question__icon">+</span></button>
        <div class="faq-answer"><p class="faq-answer__text"><?=$f["PROPERTY_ANSWER_VALUE"]?></p></div>
      </div>
      <?endforeach;?>
    </div>
  </div>
</section>
<?endif;?>
