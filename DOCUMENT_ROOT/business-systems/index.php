<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Systemsy upravlenija');
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
      <li class="breadcrumbs__current">Системы управления бизнесом</li>
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
          Системы управления бизнесом на базе Битрикс24
        </h1>
        <p class="hero__desc animate-on-scroll">
          Объединяем продажи, внутренние процессы, задачи, проекты и коммуникации в общей рабочей системе.
        </p>
        <div class="hero__actions animate-on-scroll">
          <a href="/project/" class="btn btn-accent">Обсудить внедрение</a>
          <a href="#solutions" class="btn btn-outline">Посмотреть решения</a>
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
          <h3 style="font-size:1.1875rem;font-weight:700;margin:0 0 28px;color:#fff;">Что решаем:</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;">
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Продажи под контролем</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Воронки, сделки, автоматизация</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Задачи и проекты</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Распределение и контроль сроков</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Единое рабочее пространство</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Портал, группы, документы</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Прозрачные процессы</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Согласования, уведомления, отчёты</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Когда нужна система -->
<section class="section" id="problems">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Когда нужна система</h2>
      <p class="section-heading__subtitle">Если хотя бы один пункт про вас — пора систематизировать</p>
    </div>
    <div class="grid grid--4">
      <div class="problem-card animate-on-scroll">Обращения теряются</div>
      <div class="problem-card animate-on-scroll">Сделки ведутся без единого стандарта</div>
      <div class="problem-card animate-on-scroll">Задачи распределяются в чатах</div>
      <div class="problem-card animate-on-scroll">Согласования затягиваются</div>
      <div class="problem-card animate-on-scroll">Ответственность размыта</div>
      <div class="problem-card animate-on-scroll">Руководитель не видит загрузку и статус работы</div>
      <div class="problem-card animate-on-scroll">Действующий Битрикс24 используется частично</div>
    </div>
  </div>
</section>

<!-- Что можно организовать -->
<section class="section section--alt" id="solutions">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Что можно организовать</h2>
      <p class="section-heading__subtitle">Платформа Битрикс24 покрывает все ключевые направления работы компании</p>
    </div>
    <div class="grid grid--4">
      <!-- CRM и продажи -->
      <div class="platform-card animate-on-scroll">
        <div class="platform-card__header">
          <div class="platform-card__icon platform-card__icon--bx">💬</div>
          <h3 class="platform-card__title">CRM и продажи</h3>
        </div>
        <p style="font-size:0.875rem;color:var(--text-light);margin-bottom:12px;">Заявки не теряются, продажи под контролем</p>
        <ul class="platform-card__list">
          <li>Воронки продаж и автоматизация</li>
          <li>Распределение клиентов</li>
          <li>Контроль каждой сделки</li>
          <li>История всех коммуникаций</li>
          <li>Автоматические уведомления</li>
          <li>Отчёты по эффективности</li>
        </ul>
      </div>
      <!-- Корпоративный портал -->
      <div class="platform-card animate-on-scroll">
        <div class="platform-card__header">
          <div class="platform-card__icon platform-card__icon--bx">🏢</div>
          <h3 class="platform-card__title">Корпоративный портал</h3>
        </div>
        <p style="font-size:0.875rem;color:var(--text-light);margin-bottom:12px;">Процессы автоматизированы, сотрудники работают слаженно</p>
        <ul class="platform-card__list">
          <li>Структура компании и отделы</li>
          <li>Рабочие группы и проекты</li>
          <li>База знаний и документы</li>
          <li>Внутренние объявления</li>
          <li>Сервисы для сотрудников</li>
          <li>Единое рабочее пространство</li>
        </ul>
      </div>
      <!-- Бизнес-процессы -->
      <div class="platform-card animate-on-scroll">
        <div class="platform-card__header">
          <div class="platform-card__icon platform-card__icon--bx">⚙️</div>
          <h3 class="platform-card__title">Бизнес-процессы</h3>
        </div>
        <p style="font-size:0.875rem;color:var(--text-light);margin-bottom:12px;">Согласования за минуты, а не дни</p>
        <ul class="platform-card__list">
          <li>Согласование документов</li>
          <li>Автоматическая обработка заявок</li>
          <li>Постановка задач по правилам</li>
          <li>Уведомления и напоминания</li>
          <li>Контроль сроков исполнения</li>
          <li>Маршруты процессов</li>
        </ul>
      </div>
      <!-- Задачи и проекты -->
      <div class="platform-card animate-on-scroll">
        <div class="platform-card__header">
          <div class="platform-card__icon platform-card__icon--bx">📋</div>
          <h3 class="platform-card__title">Задачи и проекты</h3>
        </div>
        <p style="font-size:0.875rem;color:var(--text-light);margin-bottom:12px;">Все задачи в системе, сроки под контролем</p>
        <ul class="platform-card__list">
          <li>Шаблоны проектов</li>
          <li>Роли и ответственность</li>
          <li>Этапы и сроки исполнения</li>
          <li>Зависимости между задачами</li>
          <li>Отчётность и аналитика</li>
        </ul>
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
      <p>Все решения реализуются на платформе <a href="/bitrix24/" style="color:var(--primary);font-weight:600;">Битрикс24</a> — облачная или коробочная версия, в зависимости от требований к безопасности и инфраструктуре.</p>
      <div style="margin-top:20px;">
        <a href="/bitrix24/" class="btn btn-outline">Подробнее о Битрикс24 →</a>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Сценарии проекта</h2>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:12px;">
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Внедрение с нуля</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Аудит и перезапуск</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Развитие существующего портала</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Миграция из другой CRM</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Переход из облака в коробку</li>
        <li style="padding:14px 16px;background:var(--bg-alt);border-left:3px solid var(--primary);border-radius:0 var(--card-radius) var(--card-radius) 0;font-size:0.9375rem;color:var(--text-light);">Сопровождение</li>
      </ul>
    </div>
  </div>
</section>

<!-- Этапы -->
<section class="section" id="stages">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Этапы</h2>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <div class="process-steps">
        <div class="process-step">
          <div class="process-step__number">1</div>
          <div class="process-step__content">
            <h4>Обследование</h4>
            <p>Изучаем текущие процессы, выявляем проблемы и точки роста</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">2</div>
          <div class="process-step__content">
            <h4>Проектирование</h4>
            <p>Проектируем архитектуру системы и сценарии использования</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">3</div>
          <div class="process-step__content">
            <h4>Настройка и разработка</h4>
            <p>Настраиваем модули, разрабатываем кастомные решения</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">4</div>
          <div class="process-step__content">
            <h4>Интеграция</h4>
            <p>Связываем с учётными системами, сайтами, коммуникациями</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">5</div>
          <div class="process-step__content">
            <h4>Тестирование</h4>
            <p>Проверяем сценарии, устраняем ошибки, оптимизируем</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">6</div>
          <div class="process-step__content">
            <h4>Обучение</h4>
            <p>Обучаем команду, готовим документацию</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">7</div>
          <div class="process-step__content">
            <h4>Запуск</h4>
            <p>Выводим систему в эксплуатацию, мониторим первые недели</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">8</div>
          <div class="process-step__content">
            <h4>Развитие</h4>
            <p>Дорабатываем, расширяем, масштабируем по мере роста</p>
          </div>
        </div>
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
<section class="section section--alt">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Обсудить систему управления компанией</h2>
      <p class="cta-section__desc">Расскажем, как Битрикс24 может решить ваши задачи — с примерами и прогнозом по цифрам.</p>
      <a href="/project/" class="btn btn-accent">Обсудить внедрение</a>
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
