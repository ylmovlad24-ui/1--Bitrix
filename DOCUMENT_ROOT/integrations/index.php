<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Integratsii');
?>

<main id="main-content">
<!-- Breadcrumb -->
<div class="breadcrumbs">
  <div class="container">
    <ul class="breadcrumbs__list">
      <li><a href="/index.php">Главная</a></li>
      <li class="breadcrumbs__separator">/</li>
      <li><a href="/business-systems/">Решения</a></li>
      <li class="breadcrumbs__separator">/</li>
      <li class="breadcrumbs__current">Интеграции</li>
    </ul>
  </div>
</div>

<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Связываем системы, чтобы данные двигались вместе с процессом</h1>
    <p class="page-hero__subtitle">Интегрируем Битрикс24, веб-системы на 1С-Битрикс, решения 1С, каналы коммуникации и внешние сервисы.</p>
    <div style="margin-top:24px;">
      <a href="/project/" class="btn btn-accent">Обсудить интеграцию</a>
    </div>
  </div>
</section>

<!-- Проблемы -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Проблемы без интеграции</h2>
      <p class="section-heading__subtitle">Системы работают изолированно — данные дублируются, процессы тормозятся</p>
    </div>
    <div class="grid grid--4">
      <div class="problem-card animate-on-scroll">Повторный ввод данных</div>
      <div class="problem-card animate-on-scroll">Расхождение цен и остатков</div>
      <div class="problem-card animate-on-scroll">Потеря обращений</div>
      <div class="problem-card animate-on-scroll">Несогласованные статусы</div>
      <div class="problem-card animate-on-scroll">Ручная передача заказов</div>
      <div class="problem-card animate-on-scroll">Отсутствие контроля ошибок</div>
      <div class="problem-card animate-on-scroll">Разрозненная информация о клиенте</div>
    </div>
  </div>
</section>

<!-- Популярные связки -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Популярные связки</h2>
      <p class="section-heading__subtitle">Самые востребованные интеграции, которые дают максимальный эффект</p>
    </div>
    <div class="grid grid--3">
      <!-- Битрикс24 и 1С -->
      <div class="integration-card animate-on-scroll">
        <h3 class="integration-card__title">Битрикс24 и 1С</h3>
        <p class="integration-card__desc">Обмен клиентами, товарами, счетами, заказами, оплатами, документами и статусами.</p>
        <div class="integration-card__tags">
          <span class="integration-card__tag">клиенты</span>
          <span class="integration-card__tag">товары</span>
          <span class="integration-card__tag">счета</span>
          <span class="integration-card__tag">заказы</span>
        </div>
      </div>
      <!-- Сайт и 1С -->
      <div class="integration-card animate-on-scroll">
        <h3 class="integration-card__title">Сайт и 1С</h3>
        <p class="integration-card__desc">Передача каталога, цен, остатков, заказов, статусов и данных личного кабинета.</p>
        <div class="integration-card__tags">
          <span class="integration-card__tag">каталог</span>
          <span class="integration-card__tag">цены</span>
          <span class="integration-card__tag">остатки</span>
          <span class="integration-card__tag">заказы</span>
        </div>
      </div>
      <!-- Сайт и Битрикс24 -->
      <div class="integration-card animate-on-scroll">
        <h3 class="integration-card__title">Сайт и Битрикс24</h3>
        <p class="integration-card__desc">Передача обращений, заказов, регистраций, источников и действий клиентов.</p>
        <div class="integration-card__tags">
          <span class="integration-card__tag">обращения</span>
          <span class="integration-card__tag">заказы</span>
          <span class="integration-card__tag">регистрации</span>
        </div>
      </div>
      <!-- Сайт — Битрикс24 — 1С -->
      <div class="integration-card animate-on-scroll">
        <h3 class="integration-card__title">Сайт — Битрикс24 — 1С</h3>
        <p class="integration-card__desc">Связанный контур онлайн-продаж, работы менеджеров и учёта.</p>
        <div class="integration-card__tags">
          <span class="integration-card__tag">полный контур</span>
          <span class="integration-card__tag">онлайн-продажи</span>
        </div>
      </div>
      <!-- Телефония и коммуникации -->
      <div class="integration-card animate-on-scroll">
        <h3 class="integration-card__title">Телефония и коммуникации</h3>
        <p class="integration-card__desc">Фиксация звонков, писем, сообщений, форм и диалогов в CRM.</p>
        <div class="integration-card__tags">
          <span class="integration-card__tag">звонки</span>
          <span class="integration-card__tag">письма</span>
          <span class="integration-card__tag">сообщения</span>
        </div>
      </div>
      <!-- API и внутренние системы -->
      <div class="integration-card animate-on-scroll">
        <h3 class="integration-card__title">API и внутренние системы</h3>
        <p class="integration-card__desc">Нестандартные интеграции с корпоративными и отраслевыми решениями.</p>
        <div class="integration-card__tags">
          <span class="integration-card__tag">API</span>
          <span class="integration-card__tag">кастомные решения</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Что проектируется -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Что проектируется</h2>
      <p class="section-heading__subtitle">Перед началом работ определяем все параметры обмена</p>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:12px;">
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Состав данных</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Направление обмена</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Источник истины</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">События запуска</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Периодичность</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Сопоставление полей</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Обработка ошибок</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Журналирование</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Права доступа</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Мониторинг</li>
      </ul>
    </div>
  </div>
</section>

<!-- Форматы реализации -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Форматы реализации</h2>
    </div>
    <div class="grid grid--3">
      <!-- Типовая -->
      <div class="format-card animate-on-scroll">
        <h3 class="format-card__title">Типовая</h3>
        <p class="format-card__desc">Используется готовый механизм при стандартном сценарии и совместимых конфигурациях.</p>
      </div>
      <!-- Адаптированная -->
      <div class="format-card animate-on-scroll">
        <h3 class="format-card__title">Адаптированная</h3>
        <p class="format-card__desc">Готовое решение дорабатывается под дополнительные поля и бизнес-правила.</p>
      </div>
      <!-- Индивидуальная -->
      <div class="format-card animate-on-scroll">
        <h3 class="format-card__title">Индивидуальная</h3>
        <p class="format-card__desc">Проектируется отдельный обмен для нестандартных систем и процессов.</p>
      </div>
    </div>
  </div>
</section>

<!-- Что НЕ является интеграцией -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Что НЕ является интеграцией</h2>
      <p class="section-heading__subtitle">Важно понимать разницу между смежными понятиями</p>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:12px;">
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--text-muted);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);"><strong>BI</strong> — анализирует и визуализирует данные</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--text-muted);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);"><strong>Миграция</strong> — однократно переносит данные</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--text-muted);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);"><strong>Автоматизация</strong> — управляет действиями внутри процесса</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--text-muted);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);"><strong>ИИ</strong> — обрабатывает информацию</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--text-muted);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);"><strong>Сопровождение</strong> — поддерживает готовое решение</li>
      </ul>
    </div>
  </div>
</section>

<!-- Этапы интеграционного проекта -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Этапы интеграционного проекта</h2>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <div class="process-steps">
        <div class="process-step">
          <div class="process-step__number">1</div>
          <div class="process-step__content">
            <h4>Обследование систем</h4>
            <p>Изучаем архитектуру, API, форматы данных обеих систем</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">2</div>
          <div class="process-step__content">
            <h4>Описание бизнес-сценариев</h4>
            <p>Фиксируем, какие данные и при каких условиях передаются</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">3</div>
          <div class="process-step__content">
            <h4>Проектирование данных и правил обмена</h4>
            <p>Определяем сопоставление полей, форматы, источники истины</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">4</div>
          <div class="process-step__content">
            <h4>Выбор способа реализации</h4>
            <p>Типовая, адаптированная или индивидуальная интеграция</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">5</div>
          <div class="process-step__content">
            <h4>Создание тестового контура</h4>
            <p>Настраиваем изолированную среду для отладки обмена</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">6</div>
          <div class="process-step__content">
            <h4>Разработка и настройка</h4>
            <p>Реализуем обмен, настраиваем события и обработку ошибок</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">7</div>
          <div class="process-step__content">
            <h4>Тестирование исключений</h4>
            <p>Проверяем граничные случаи, ошибки, повторные сценарии</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">8</div>
          <div class="process-step__content">
            <h4>Запуск</h4>
            <p>Выводим интеграцию в эксплуатацию, запускаем мониторинг</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">9</div>
          <div class="process-step__content">
            <h4>Мониторинг и сопровождение</h4>
            <p>Отслеживаем ошибки, оптимизируем, расширяем по мере роста</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Заказать обследование интеграции</h2>
      <p class="cta-section__desc">Бесплатно проанализируем ваши системы и предложим оптимальный формат интеграции.</p>
      <a href="/project/" class="btn btn-accent">Обсудить интеграцию</a>
    </div>
  </div>
</section>

<!-- Sticky CTA (mobile only) -->
<div class="sticky-cta" id="stickyCta">
  <a href="tel:+738520000000" class="btn btn-primary">📞 Позвонить</a>
  <a href="/project/" class="btn btn-accent">Заявка</a>
</div>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
