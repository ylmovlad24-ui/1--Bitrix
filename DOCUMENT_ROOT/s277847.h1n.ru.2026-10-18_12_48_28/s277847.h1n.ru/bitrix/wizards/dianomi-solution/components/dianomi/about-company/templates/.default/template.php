<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['ELEMENT'])):
    $el = $arResult['ELEMENT'];
    $features = explode("\n", $el['FEATURES']);
?>
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">О Dianomi</h2>
    </div>
    <div class="about-section animate-on-scroll">
      <p class="about-section__desc"><?=$el['DESCRIPTION']?></p>
      <p class="about-section__desc"><?=$el['OFFICE']?></p>
    </div>
    <div class="about-features">
      <?php foreach ($features as $feature): ?>
        <?php if (trim($feature)): ?>
        <div class="about-feature animate-on-scroll">
          <h3 class="about-feature__title"><?=trim($feature)?></h3>
        </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
