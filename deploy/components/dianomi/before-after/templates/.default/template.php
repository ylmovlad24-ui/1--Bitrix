<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['ELEMENT'])):
    $el = $arResult['ELEMENT'];
?>
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Как изменится работа после проекта</h2>
    </div>
    <div class="ba-section">
      <div class="ba-container">
        <div class="ba-column ba-column--before">
          <h3 class="ba-column__title"><?=$el['BEFORE_TITLE']?></h3>
          <ul class="ba-list"><?=$el['BEFORE_LIST']?></ul>
        </div>
        <div class="ba-divider">
          <div class="ba-divider__icon">→</div>
        </div>
        <div class="ba-column ba-column--after">
          <h3 class="ba-column__title"><?=$el['AFTER_TITLE']?></h3>
          <ul class="ba-list"><?=$el['AFTER_LIST']?></ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
