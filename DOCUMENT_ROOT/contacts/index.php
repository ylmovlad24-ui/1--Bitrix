<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Kontakty - Dianomi');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Контакты</h1>
    <p class="page-hero__subtitle">Свяжитесь с нами любым удобным способом</p>
  </div>
</section>

<!-- Contact Info -->
<section class="section">
  <div class="container">
    <div class="contact-block" style="max-width:680px;">
      <div class="contact-block__item animate-on-scroll">
        <div class="contact-block__icon">📞</div>
        <div class="contact-block__text">
          <h4>Телефон</h4>
          <a href="tel:+738520000000">+7 (3852) 000-00-00</a>
        </div>
      </div>
      <div class="contact-block__item animate-on-scroll">
        <div class="contact-block__icon">✉️</div>
        <div class="contact-block__text">
          <h4>Email</h4>
          <a href="mailto:info@dianomi.ru">info@dianomi.ru</a>
        </div>
      </div>
      <div class="contact-block__item animate-on-scroll">
        <div class="contact-block__icon">💬</div>
        <div class="contact-block__text">
          <h4>Telegram</h4>
          <a href="https://t.me/dianomi_barnaul" target="_blank">@dianomi_barnaul</a>
        </div>
      </div>
      <div class="contact-block__item animate-on-scroll">
        <div class="contact-block__icon">📍</div>
        <div class="contact-block__text">
          <h4>Адрес</h4>
          <p>г. Барнаул</p>
        </div>
      </div>
      <div class="contact-block__item animate-on-scroll">
        <div class="contact-block__icon">🕐</div>
        <div class="contact-block__text">
          <h4>Часы работы</h4>
          <p>пн-пт 09:00–18:00</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section--alt">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Обсудим ваш проект</h2>
      <p class="cta-section__desc">Заполните форму или свяжитесь с нами напрямую. Мы ответим в рабочее время.</p>
      <a href="/project/" class="btn btn-accent">Обсудить проект</a>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
