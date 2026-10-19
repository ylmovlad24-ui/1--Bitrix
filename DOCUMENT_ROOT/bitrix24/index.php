<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Oblachnyy Bitrix24');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Битрикс24, спроектированный под работу компании</h1>
    <p class="page-hero__subtitle">Сервис, в котором собраны инструменты для эффективной работы компании. Коммуникации, продажи, управление проектами — всё внутри. Внедряем, перезапускаем и развиваем облачный и коробочный Битрикс24 с учётом процессов, ролей и требований к инфраструктуре.</p>
    <div style="margin-top:24px;">
      <a href="/project/" class="btn btn-accent">Обсудить внедрение</a>
    </div>
  </div>
</section>

<!-- Функционал платформы -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Функционал платформы</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Битрикс24 объединяет все инструменты для эффективной работы компании</p>
    </div>
    <div class="grid grid--4">
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">💬</div>
        <h3 class="solution-card__title">CRM и продажи</h3>
        <p class="solution-card__desc">Воронки продаж, автоматизация, контроль сделок, история коммуникаций.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📞</div>
        <h3 class="solution-card__title">Контакт-центр</h3>
        <p class="solution-card__desc">Фиксация звонков, писем, сообщений. Единая история взаимодействий.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">⚙️</div>
        <h3 class="solution-card__title">Внутренние процессы</h3>
        <p class="solution-card__desc">Согласования, маршрутизация, автоматические уведомления и контроль сроков.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📋</div>
        <h3 class="solution-card__title">Задачи и проекты</h3>
        <p class="solution-card__desc">Шаблоны проектов, роли, этапы, зависимости, отчётность.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🏢</div>
        <h3 class="solution-card__title">Корпоративный портал</h3>
        <p class="solution-card__desc">Структура компании, рабочие группы, база знаний, сервисы для сотрудников.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📊</div>
        <h3 class="solution-card__title">Отчётность</h3>
        <p class="solution-card__desc">Показатели по отделам, сотрудникам, сделкам и процессам.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🤖</div>
        <h3 class="solution-card__title">CoPilot</h3>
        <p class="solution-card__desc">AI-ассистент для повседневных задач: напишет текст, сгенерирует изображение, поставит задачу.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">⚡</div>
        <h3 class="solution-card__title">Автоматизация</h3>
        <p class="solution-card__desc">Цифровые рабочие места, роботы для рутинных задач, BI-конструктор отчётов.</p>
      </div>
    </div>
  </div>
</section>

<!-- Облако или коробка -->
<section class="section" id="compare">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Облако или коробка</h2>
    </div>
    <div style="overflow-x:auto;" class="animate-on-scroll">
      <table class="comparison-table">
        <thead>
          <tr>
            <th>Критерий</th>
            <th>Облачный Битрикс24</th>
            <th>Коробочный Битрикс24</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Размещение</td><td>Инфраструктура поставщика</td><td>Собственный или арендованный сервер</td></tr>
          <tr><td>Запуск</td><td>Обычно быстрее</td><td>Требует подготовки инфраструктуры</td></tr>
          <tr><td>Серверное администрирование</td><td>Не требуется со стороны клиента</td><td>Требуется</td></tr>
          <tr><td>Глубокая доработка</td><td>Ограничена возможностями облака</td><td>Доступно больше вариантов</td></tr>
          <tr><td>Контроль инфраструктуры</td><td>Ограниченный</td><td>Расширенный</td></tr>
          <tr><td>Закрытый контур</td><td>Не основной сценарий</td><td>Возможен</td></tr>
          <tr><td>Обновления</td><td>Выполняются поставщиком</td><td>Требуют планирования</td></tr>
          <tr><td>Стоимость владения</td><td>Обычно проще на старте</td><td>Включает инфраструктуру и обслуживание</td></tr>
        </tbody>
      </table>
    </div>
    <div style="text-align:center;margin-top:24px;" class="animate-on-scroll">
      <p style="font-size:1rem;color:var(--text-light);margin-bottom:12px;">Нужны конкретные цены?</p>
      <a href="/bitrix24-prices/" class="btn btn-outline">Сравнить тарифы и цены</a>
      <div style="text-align:center;margin-top:12px;" class="animate-on-scroll">
        <p style="font-size:1rem;color:var(--text-light);margin-bottom:12px;">Нужна коробочная версия?</p>
        <a href="/bitrix24-on-premise/" class="btn btn-outline">Подробнее о коробочной версии →</a>
      </div>
    </div>
  </div>
</section>

<!-- Бизнес-задачи -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Бизнес-задачи</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Если вам нужно не просто «установить CRM», а решить конкретные бизнес-задачи — начните с нашей страницы по системам управления</p>
    </div>
    <div style="text-align:center;margin-top:24px;" class="animate-on-scroll">
      <a href="/business-systems/" class="btn btn-accent">Системы управления бизнесом →</a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Подберём вариант Битрикс24</h2>
      <p class="cta-section__desc">Расскажите о вашей задаче и требованиях. Определим, какой вариант размещения подходит именно вам.</p>
      <a href="/project/" class="btn btn-accent">Обсудить вариант</a>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
