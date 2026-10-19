<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Tarify Bitrix24');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Тарифы Битрикс24</h1>
    <p class="page-hero__subtitle">Официальные облачные тарифы и коробочная лицензия. Внедрение и сопровождение от авторизованного партнёра.</p>
  </div>
</section>

<!-- Облачные тарифы -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Облачные тарифы</h2>
      <p class="section-heading__subtitle">Выберите подходящий тариф в зависимости от размера компании и задач</p>
    </div>
    <div class="grid grid--4">
      <!-- Стартовый -->
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Стартовый</h3>
        <div class="edition-card__price">699 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес</div>
        <ul class="edition-card__features">
          <li>CRM с воронками продаж</li>
          <li>Задачи и проекты</li>
          <li>Корпоративный чат</li>
          <li>2 ГБ хранилища</li>
          <li>1 сайт</li>
          <li>Телефония</li>
        </ul>
        <a href="/project/" class="btn btn-outline btn-full">Выбрать</a>
      </div>
      <!-- Базовый -->
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Базовый</h3>
        <div class="edition-card__price">999 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес</div>
        <ul class="edition-card__features">
          <li>Всё из «Стартового»</li>
          <li>Интернет-магазин</li>
          <li>Маркетинговые инструменты</li>
          <li>10 ГБ хранилища</li>
          <li>Автоматизация процессов</li>
          <li>Контакт-центр</li>
        </ul>
        <a href="/project/" class="btn btn-outline btn-full">Выбрать</a>
      </div>
      <!-- Профессиональный -->
      <div class="edition-card edition-card--featured animate-on-scroll">
        <h3 class="edition-card__name">Профессиональный</h3>
        <div class="edition-card__price">1 499 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес</div>
        <ul class="edition-card__features">
          <li>Всё из «Базового»</li>
          <li>BPM-модель</li>
          <li>Интеграции с 1С</li>
          <li>AI-инструменты</li>
          <li>50 ГБ хранилища</li>
          <li>Сегментация контактов</li>
        </ul>
        <a href="/project/" class="btn btn-accent btn-full">Выбрать</a>
      </div>
      <!-- Корпоративный -->
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Корпоративный</h3>
        <div class="edition-card__price">1 999 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес</div>
        <ul class="edition-card__features">
          <li>Всё из «Профессионального»</li>
          <li>Безлимитное хранилище</li>
          <li>Call-центр</li>
          <li>SLA 99.9%</li>
          <li>200 ГБ хранилища</li>
          <li>Приоритетная поддержка</li>
        </ul>
        <a href="/project/" class="btn btn-outline btn-full">Выбрать</a>
      </div>
    </div>
    <p style="font-size:0.8125rem;color:var(--text-muted);text-align:center;margin-top:24px;" class="animate-on-scroll">
      При годовой оплате скидка ~15%. Точные цены уточняйте на bitrix24.ru
    </p>
  </div>
</section>

<!-- Годовая оплата -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Годовая оплата — выгоднее</h2>
      <p class="section-heading__subtitle">При оплате за год — скидка около 15% на любой тариф</p>
    </div>
    <div class="grid grid--4">
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Стартовый</h3>
        <div class="edition-card__price">599 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес при оплате за год</div>
      </div>
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Базовый</h3>
        <div class="edition-card__price">849 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес при оплате за год</div>
      </div>
      <div class="edition-card edition-card--featured animate-on-scroll">
        <h3 class="edition-card__name">Профессиональный</h3>
        <div class="edition-card__price">1 299 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес при оплате за год</div>
      </div>
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Корпоративный</h3>
        <div class="edition-card__price">1 699 ₽</div>
        <div class="edition-card__price-period">за пользователя/мес при оплате за год</div>
      </div>
    </div>
  </div>
</section>

<!-- Коробочная лицензия -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Коробочная лицензия</h2>
      <p class="section-heading__subtitle">Для компаний, которым нужна собственная инфраструктура</p>
    </div>
    <div class="platform-card animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <div class="platform-card__header">
        <div class="platform-card__icon platform-card__icon--1c">📦</div>
        <h3 class="platform-card__title">Коробочный Битрикс24</h3>
      </div>
      <p class="platform-card__desc">Размещение на собственном или арендованном сервере. Полная кастомизация, глубокая интеграция с внутренними системами, закрытый контур.</p>
      <div style="margin-top:16px;">
        <h4 style="font-size:0.9375rem;margin-bottom:8px;color:var(--text);">Что входит:</h4>
        <ul style="list-style:none;padding:0;margin:0 0 16px;">
          <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ лицензия от 60 000 ₽</li>
          <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ собственная инфраструктура</li>
          <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ полная кастомизация</li>
          <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);">→ глубокая интеграция с внутренними системами</li>
        </ul>
        <p style="font-size:0.8125rem;color:var(--text-muted);margin:0;">Инфраструктура (сервер, администрирование) оплачивается отдельно. Точная стоимость зависит от количества пользователей и требований.</p>
      </div>
    </div>
  </div>
</section>

<!-- Внедрение от Dianomi -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Внедрение от Dianomi</h2>
      <p class="section-heading__subtitle">Авторизованный партнёр 1С-Битрикс. Внедрение, обучение, сопровождение.</p>
    </div>
    <div class="grid grid--2">
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Базовое внедрение</h3>
        <p style="font-size:0.9375rem;color:var(--text-light);margin-bottom:12px;">Настройка CRM, создание воронок продаж, базовые задачи и проекты, обучение пользователей.</p>
        <div style="font-size:1.25rem;font-weight:var(--font-weight-bold);color:var(--primary);margin-bottom:12px;">от 60 000 ₽</div>
        <a href="/project/" class="btn btn-outline btn-full">Обсудить</a>
      </div>
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Стандартное внедрение</h3>
        <p style="font-size:0.9375rem;color:var(--text-light);margin-bottom:12px;">CRM + интеграции, бизнес-процессы, автоматизация, обучение команды, настройка отчётности.</p>
        <div style="font-size:1.25rem;font-weight:var(--font-weight-bold);color:var(--primary);margin-bottom:12px;">от 150 000 ₽</div>
        <a href="/project/" class="btn btn-outline btn-full">Обсудить</a>
      </div>
      <div class="edition-card edition-card--featured animate-on-scroll">
        <h3 class="edition-card__name">Комплексное внедрение</h3>
        <p style="font-size:0.9375rem;color:var(--text-light);margin-bottom:12px;">Полная кастомизация, интеграции с 1С и сайтом, BI-аналитика, миграция данных, обучение.</p>
        <div style="font-size:1.25rem;font-weight:var(--font-weight-bold);color:var(--primary);margin-bottom:12px;">от 300 000 ₽</div>
        <a href="/project/" class="btn btn-accent btn-full">Обсудить</a>
      </div>
      <div class="edition-card animate-on-scroll">
        <h3 class="edition-card__name">Сопровождение</h3>
        <p style="font-size:0.9375rem;color:var(--text-light);margin-bottom:12px;">Поддержка пользователей, развитие процессов, новые интеграции, обновления, мониторинг.</p>
        <div style="font-size:1.25rem;font-weight:var(--font-weight-bold);color:var(--primary);margin-bottom:12px;">от 20 000 ₽/мес</div>
        <a href="/project/" class="btn btn-outline btn-full">Обсудить</a>
      </div>
    </div>
    <p style="font-size:0.8125rem;color:var(--text-muted);text-align:center;margin-top:24px;" class="animate-on-scroll">
      Точная стоимость определяется после обследования и проектирования архитектуры.
    </p>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Подберём тариф и формат внедрения</h2>
      <p class="cta-section__desc">Расскажите о вашей задаче. Определим подходящий тариф Битрикс24 и рассчитаем стоимость внедрения.</p>
      <a href="/project/" class="btn btn-accent">Обсудить проект</a>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
