<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['STEPS'])):
?>
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Наш подход: от картины к деталям</h2>
    </div>
    <div class="approach-grid">
      <?php foreach ($arResult['STEPS'] as $step): ?>
      <div class="approach-step">
        <div class="approach-step__number"><?=$step['STEP_NUMBER']?></div>
        <h4 class="approach-step__title"><?=$step['TITLE']?></h4>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:24px;" class="animate-on-scroll">
      <a href="/about.php" class="btn btn-outline">Как мы работаем</a>
    </div>
  </div>
</section>
<?php endif; ?>
