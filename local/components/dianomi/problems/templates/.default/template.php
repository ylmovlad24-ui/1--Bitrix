<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadString('<link rel="stylesheet" href="'.SITE_TEMPLATE_PATH.'/components/dianomi/problems/templates/.default/style.css">');

$res = CIBlockElement::GetList(array("PROPERTY_ORDER" => "ASC"), array("IBLOCK_CODE" => "page_problems"), false, false, array("ID", "NAME", "PROPERTY_ICON", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION"));
$problems = array();
while ($ar = $res->GetNext()) $problems[] = $ar;
?>

<?if($problems):?>
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Узнаёте себя?</h2>
      <p class="section-heading__subtitle">Если хотя бы одна из этих ситуаций про вашу компанию — пора менять систему</p>
    </div>
    <div class="problems-grid">
      <?foreach($problems as $p):?>
      <div class="problem-card">
        <div class="problem-card__header">
          <span class="problem-card__icon"><?=$p["PROPERTY_ICON_VALUE"]?></span>
          <strong class="problem-card__title"><?=$p["PROPERTY_TITLE_VALUE"]?></strong>
        </div>
        <p class="problem-card__desc"><?=$p["PROPERTY_DESCRIPTION_VALUE"]?></p>
      </div>
      <?endforeach;?>
    </div>
    <div style="text-align:center;margin-top:32px;" class="animate-on-scroll">
      <p style="font-size:1.0625rem;color:var(--text-light);margin-bottom:16px;">Знакомые проблемы? Мы решаем их комплексно.</p>
      <a href="/contacts.php" class="btn btn-accent">Обсудить проект</a>
    </div>
  </div>
</section>
<?endif;?>
