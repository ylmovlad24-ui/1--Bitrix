<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateFolder */

if (!empty($arResult['ELEMENT'])):
    $el = $arResult['ELEMENT'];
?>
<section class="hero">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <div class="hero__badge animate-on-scroll">
          <svg viewBox="0 0 16 16" fill="none" width="16" height="16">
            <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
            <path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <?=$el['BADGE_TEXT']?>
        </div>
        <h1 class="hero__title animate-on-scroll"><?=$el['TITLE']?></h1>
        <p class="hero__desc animate-on-scroll"><?=$el['DESCRIPTION']?></p>
        <div class="hero__actions animate-on-scroll">
          <a href="/contacts.php" class="btn btn-accent">Обсудить проект</a>
          <a href="#route" class="btn btn-outline">Посмотреть решения</a>
        </div>
        <div class="hero-stats">
          <div class="hero-stat">
            <div class="hero__stat-number" data-count="<?=$el['COUNTER_1']?>">0</div>
            <div class="hero__stat-label"><?=$el['COUNTER_LABEL_1']?></div>
          </div>
          <div class="hero-stat">
            <div class="hero__stat-number" data-count="<?=$el['COUNTER_2']?>">0</div>
            <div class="hero__stat-label"><?=$el['COUNTER_LABEL_2']?></div>
          </div>
          <div class="hero-stat">
            <div class="hero__stat-number"><?=$el['COUNTER_3']?></div>
            <div class="hero__stat-label"><?=$el['COUNTER_LABEL_3']?></div>
          </div>
        </div>
      </div>
      <div class="hero__visual animate-on-scroll">
        <div style="background:linear-gradient(135deg, #1E4474, #2A5B9A);border:1px solid rgba(42,91,154,0.6);border-radius:20px;padding:36px;box-shadow:0 8px 32px rgba(0,0,0,0.15);">
          <h3 style="font-size:1.1875rem;font-weight:700;margin:0 0 28px;color:#fff;">Что решаем вместе:</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;"><?=$el['BENEFITS_LIST']?></ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
