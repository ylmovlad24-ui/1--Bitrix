<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['SOLUTIONS'])):
?>
<section class="section" id="route">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Какая у вас задача?</h2>
      <p class="section-heading__subtitle">Выберите направление — перейдёте к подробному описанию решений</p>
    </div>
    <div class="solutions-grid">
      <?php foreach ($arResult['SOLUTIONS'] as $solution): ?>
      <div class="solution-card" style="border-top:4px solid <?=$solution['BORDER_COLOR']?>;">
        <div class="solution-card__icon"><?=$solution['ICON']?></div>
        <h3 class="solution-card__title"><?=$solution['TITLE']?></h3>
        <p class="solution-card__desc"><?=$solution['DESCRIPTION']?></p>
        <div class="solution-card__divider">
          <p class="solution-card__label">Что получите:</p>
          <ul class="solution-card__benefits"><?=$solution['BENEFITS']?></ul>
        </div>
        <a href="<?=$solution['LINK_URL']?>" class="solution-card__link"><?=$solution['LINK_TEXT']?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
