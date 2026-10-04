<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
?>

<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Расскажите о задаче — предложим решение</h2>
      <p class="cta-section__desc">Заполните форму — свяжемся в течение рабочего дня.</p>
      <form id="ctaForm" class="cta-form" action="<?=$arResult['FORM_ACTION']?>" method="POST">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Имя" required>
        </div>
        <div class="form-group">
          <input type="tel" name="phone" class="form-control" placeholder="Телефон" required>
        </div>
        <div class="form-group">
          <textarea name="message" class="form-control" placeholder="Опишите задачу" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-accent btn-full">Отправить</button>
      </form>
      <p class="cta-section__note">
        Или напишите в Telegram: <a href="https://t.me/dianomi" target="_blank" rel="noopener">@dianomi</a>
      </p>
    </div>
  </div>
</section>
