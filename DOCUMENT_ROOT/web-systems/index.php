<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Web-sistemy');
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
      <li class="breadcrumbs__current">Веб-системы</li>
    </ul>
  </div>
</div>

<!-- 1. Hero -->
<section class="hero">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <div class="hero__badge animate-on-scroll">
          <svg viewBox="0 0 16 16" fill="none" width="16" height="16"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Авторизованный партнёр 1С-Битрикс
        </div>
        <h1 class="hero__title animate-on-scroll">
          Веб-системы для продаж, клиентов и партнёров
        </h1>
        <p class="hero__desc animate-on-scroll">
          Создаём на 1С-Битрикс корпоративные сайты, интернет-магазины, B2B-порталы и личные кабинеты, связанные с CRM и учётными системами.
        </p>
        <div class="hero__actions animate-on-scroll">
          <a href="/project/" class="btn btn-accent">Обсудить веб-проект</a>
          <a href="#types" class="btn btn-outline">Посмотреть типы</a>
        </div>
        <div class="hero-stats" style="display:flex;gap:32px;justify-content:center;margin-top:48px;">
          <div class="hero-stat" style="text-align:center;">
            <div class="hero__stat-number" data-count="10" style="font-size:1.75rem;">0</div>
            <div class="hero__stat-label">лет на рынке</div>
          </div>
          <div class="hero-stat" style="text-align:center;">
            <div class="hero__stat-number" data-count="53" style="font-size:1.75rem;">0</div>
            <div class="hero__stat-label">реализованных проектов</div>
          </div>
          <div class="hero-stat" style="text-align:center;">
            <div class="hero__stat-number" style="font-size:1.75rem;">4 месяца</div>
            <div class="hero__stat-label">окупаемость проекта</div>
          </div>
        </div>
      </div>
      <div class="hero__visual animate-on-scroll">
        <div style="background:linear-gradient(135deg, #1E4474, #2A5B9A);border:1px solid rgba(42,91,154,0.6);border-radius:20px;padding:36px;box-shadow:0 8px 32px rgba(0,0,0,0.15);position:relative;overflow:hidden;">
          <h3 style="font-size:1.1875rem;font-weight:700;margin:0 0 28px;color:#fff;">Что создаём:</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;">
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Корпоративные сайты</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Представление компании и продуктов</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Интернет-магазины</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Каталог, заказы, оплаты, доставка</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">B2B-порталы</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Персональные условия, заказы, документы</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Личные кабинеты</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">История, заявки, статусы, уведомления</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Типы веб-систем -->
<section class="section" id="types">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Типы веб-систем</h2>
      <p class="section-heading__subtitle">Каждый тип решает свою задачу и связывается с CRM и учётными системами</p>
    </div>
    <div class="grid grid--3">
      <!-- Корпоративный сайт -->
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🏢</div>
        <h3 class="solution-card__title">Корпоративный сайт</h3>
        <p class="solution-card__desc">Представление компании, продуктов, компетенций и проектов с передачей обращений в CRM.</p>
      </div>
      <!-- Интернет-магазин -->
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🛒</div>
        <h3 class="solution-card__title">Интернет-магазин</h3>
        <p class="solution-card__desc">Каталог, цены, остатки, заказы, оплаты, доставка и интеграция с учётной системой.</p>
      </div>
      <!-- B2B- и дилерский портал -->
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🤝</div>
        <h3 class="solution-card__title">B2B- и дилерский портал</h3>
        <p class="solution-card__desc">Персональные условия, остатки, заказы, документы, статусы и работа с партнёрами.</p>
      </div>
      <!-- Личный кабинет -->
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">👤</div>
        <h3 class="solution-card__title">Личный кабинет</h3>
        <p class="solution-card__desc">История взаимодействия, заявки, документы, оплаты, уведомления и статусы.</p>
      </div>
      <!-- Каталог продукции -->
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📦</div>
        <h3 class="solution-card__title">Каталог продукции</h3>
        <p class="solution-card__desc">Структурированный каталог с фильтрацией, техническими характеристиками и обменом с 1С.</p>
      </div>
    </div>
  </div>
</section>

<!-- Интеграции -->
<section class="section section--alt" id="integrations">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Интеграции</h2>
      <p class="section-heading__subtitle">Веб-система работает эффективно, когда связана с остальными сервисами</p>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:12px;">
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">С 1С — каталоги, остатки, цены, заказы</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">С Битрикс24 — CRM, задачи, портал</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">С платёжными системами</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Со службами доставки</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">С маркетплейсами</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">С внешними каталогами</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--accent);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">С сервисами уведомлений</li>
      </ul>
    </div>
  </div>
</section>

<!-- Работа с существующими проектами -->
<section class="section" id="existing">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Работа с существующими проектами</h2>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:12px;">
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Технический аудит</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Модернизация</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Развитие</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Оптимизация производительности</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Обновление</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Перенос</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Сопровождение</li>
      </ul>
    </div>
  </div>
</section>

<!-- Этапы разработки -->
<section class="section section--alt" id="stages">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Этапы разработки</h2>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <div class="process-steps">
        <div class="process-step">
          <div class="process-step__number">1</div>
          <div class="process-step__content">
            <h4>Определение целей и пользователей</h4>
            <p>Понимаем, для кого создаём систему и какие задачи она решает</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">2</div>
          <div class="process-step__content">
            <h4>Проектирование сценариев</h4>
            <p>Описываем пользовательские сценарии и пути клиентов</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">3</div>
          <div class="process-step__content">
            <h4>Разработка структуры и прототипов</h4>
            <p>Создаём карту сайта, прототипы страниц и навигации</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">4</div>
          <div class="process-step__content">
            <h4>Создание дизайна</h4>
            <p>Разрабатываем дизайн-макеты с учётом конверсии и UX</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">5</div>
          <div class="process-step__content">
            <h4>Разработка</h4>
            <p>Верстаем и программируем на 1С-Битрикс с оптимизацией</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">6</div>
          <div class="process-step__content">
            <h4>Интеграция</h4>
            <p>Связываем с CRM, учётными системами, платёжными сервисами</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">7</div>
          <div class="process-step__content">
            <h4>Тестирование</h4>
            <p>Проверяем все сценарии, производительность, безопасность</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">8</div>
          <div class="process-step__content">
            <h4>Запуск</h4>
            <p>Выводим систему в эксплуатацию, настраиваем мониторинг</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">9</div>
          <div class="process-step__content">
            <h4>Сопровождение</h4>
            <p>Поддерживаем, дорабатываем, развиваем по метрикам</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Платформа -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Платформа</h2>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;text-align:center;font-size:1.0625rem;color:var(--text-light);line-height:1.8;">
      <p>Все веб-системы создаём на платформе <a href="/1c-bitrix/" style="color:var(--primary);font-weight:600;">1С-Битрикс</a> — профессиональной CMS с встроенной интеграцией с 1С, соответствием законодательству и экосистемой готовых решений.</p>
      <div style="margin-top:20px;">
        <a href="/1c-bitrix/" class="btn btn-outline">Подробнее о платформе 1С-Битрикс →</a>
      </div>
    </div>
  </div>
</section>

<!-- Связанные платформы -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Платформа</h2>
    </div>
    <div class="grid grid--2">
      <div class="solution-card animate-on-scroll" style="padding:24px;">
        <h3 style="font-size:1.0625rem;margin-bottom:8px;">1С-Битрикс — CMS для веб-проектов</h3>
        <p style="font-size:0.9375rem;color:var(--text-light);margin-bottom:16px;">Профессиональная система управления сайтами: корпоративные порталы, интернет-магазины, B2B-порталы. Встроенная интеграция с 1С, соответствие ФЗ-54 и ФЗ-152.</p>
        <a href="/1c-bitrix/" class="btn btn-outline btn-sm">Подробнее о 1С-Битрикс →</a>
      </div>
      <div class="solution-card animate-on-scroll" style="padding:24px;">
        <h3 style="font-size:1.0625rem;margin-bottom:8px;">Битрикс24 — CRM и корпоративный портал</h3>
        <p style="font-size:0.9375rem;color:var(--text-light);margin-bottom:16px;">Объединяет продажи, коммуникации, задачи и проекты. Создаём сайты на 1С-Битрикс, связанные с Битрикс24 для передачи обращений в CRM.</p>
        <a href="/bitrix24/" class="btn btn-outline btn-sm">Подробнее о Битрикс24 →</a>
      </div>
    </div>
  </div>
</section>

<!-- Наш подход -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Наш подход: от картины к деталям</h2>
    </div>
    <div style="max-width:960px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;">1</div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;">Выясняем, что болит, и что считаем успешным</h4>
      </div>
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;">2</div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;">Собираем карту текущих процессов и систем</h4>
      </div>
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;">3</div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;">Рисуем, как система будет работать после</h4>
      </div>
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;">4</div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;">Разбиваем на этапы, чтобы видеть результат сразу</h4>
      </div>
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;">5</div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;">Реализуем и подключаем каждый контур</h4>
      </div>
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;">6</div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;">Проверяем, запускаем и остаёмся на поддержке</h4>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Обсудить веб-систему</h2>
      <p class="cta-section__desc">Расскажем, какой тип веб-системы подойдёт для вашей задачи — с примерами и прогнозом по цифрам.</p>
      <a href="/project/" class="btn btn-accent">Обсудить веб-проект</a>
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
