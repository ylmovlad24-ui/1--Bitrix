<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

if (!empty($arResult['PROBLEMS'])):
?>
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Узнаёте себя?</h2>
      <p class="section-heading__subtitle">Если хотя бы одна из этих ситуаций про вашу компанию — пора менять систему</p>
    </div>
    <div class="problems-grid">
      <?php foreach ($arResult['PROBLEMS'] as $problem): ?>
      <div class="problem-card">
        <div class="problem-card__header">
          <span class="problem-card__icon"><?=$problem['ICON']?></span>
          <strong class="problem-card__title"><?=$problem['TITLE']?></strong>
        </div>
        <p class="problem-card__desc"><?=$problem['DESCRIPTION']?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:32px;" class="animate-on-scroll">
      <p style="font-size:1.0625rem;color:var(--text-light);margin-bottom:16px;">Знакомые проблемы? Мы решаем их комплексно.</p>
      <a href="/contacts.php" class="btn btn-accent">Обсудить проект</a>
    </div>
  </div>
</section>
<?php endif; ?>
