<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Keysy');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Проекты Dianomi</h1>
    <p class="page-hero__subtitle">Показываем исходную задачу, архитектуру решения, выполненные работы и подтверждённый результат.</p>
  </div>
</section>

<!-- Projects placeholder -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Проекты, о которых можно рассказать лично</h2>
    </div>
    <div style="max-width:720px;margin:0 auto;text-align:center;" class="animate-on-scroll">
      <p style="font-size:1.0625rem;color:var(--text-light);line-height:1.8;margin-bottom:24px;">
        Часть решений реализуется для внутренних процессов клиентов и не может быть опубликована полностью. На встрече покажем релевантные примеры в допустимом объёме.
      </p>
      <p style="font-size:1.0625rem;color:var(--text-light);line-height:1.8;margin-bottom:32px;">
        Мы не создаём вымышленные кейсы, цифры и названия клиентов. Каждый опубликованный проект — это реальная работа с подтверждённым результатом.
      </p>
      <a href="/project/" class="btn btn-accent">Обсудить похожий проект</a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section--alt">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Хотите стать следующим кейсом?</h2>
      <p class="cta-section__desc">Расскажите о вашей задаче — возможно, следующий проект станет примером для других компаний.</p>
      <a href="/project/" class="btn btn-accent">Начать проект</a>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
