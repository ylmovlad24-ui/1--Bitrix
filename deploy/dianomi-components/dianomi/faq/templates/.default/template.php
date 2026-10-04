<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['FAQ'])):
?>
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Частые вопросы</h2>
    </div>
    <div class="faq-list animate-on-scroll">
      <?php foreach ($arResult['FAQ'] as $faq): ?>
      <div class="faq-item">
        <button class="faq-question">
          <span><?=$faq['QUESTION']?></span>
          <span class="faq-question__icon">+</span>
        </button>
        <div class="faq-answer">
          <p class="faq-answer__text"><?=$faq['ANSWER']?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
