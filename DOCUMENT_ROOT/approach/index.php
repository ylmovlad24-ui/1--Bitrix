<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Kak my rabotaem');
?>

<main id="main-content">
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
          Проектируем до того, как начинаем настраивать
        </h1>
        <p class="hero__desc animate-on-scroll">
          Фиксируем задачу, границы и архитектуру решения, чтобы управлять сроками, бюджетом и изменениями.
        </p>
        <div class="hero__actions animate-on-scroll">
          <a href="/project/" class="btn btn-accent">Обсудить проект</a>
          <a href="#" class="btn btn-outline">Как мы работаем</a>
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
          <h3 style="font-size:1.1875rem;font-weight:700;margin:0 0 28px;color:#fff;">Наш подход:</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;">
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">От картины к деталям</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Сначала архитектура, потом настройка</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Прозрачные сроки</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Фиксируем бюджет и этапы</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Демонстрации на каждом этапе</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Видите результат сразу</p>
              </div>
            </li>
            <li style="display:flex;align-items:flex-start;gap:14px;padding:14px 16px;background:rgba(255,255,255,0.12);border-radius:12px;border:1px solid rgba(255,255,255,0.2);">
              <span style="flex-shrink:0;width:28px;height:28px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">✓</span>
              <div>
                <p style="font-size:1.0625rem;color:#fff;font-weight:600;margin:0 0 4px;">Сопровождение после запуска</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.9);margin:0;">Поддержка и развитие системы</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Квалификационная встреча -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Квалификационная встреча</h2>
    </div>
    <div class="solution-card animate-on-scroll" style="margin-bottom:24px;">
      <h3 style="margin-bottom:12px;">До 20–30 минут</h3>
      <ul style="list-style:none;padding:0;margin:0 0 16px;">
        <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);">→ знакомство</li>
        <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);">→ общая оценка задачи</li>
        <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);">→ проверка соответствия специализации</li>
        <li style="padding:6px 0;font-size:0.9375rem;color:var(--text-light);">→ определение следующего шага</li>
      </ul>
      <div style="background:rgba(231,76,60,0.06);border-left:3px solid var(--error);padding:12px 16px;border-radius:0 var(--card-radius) var(--card-radius) 0;">
        <p style="font-size:0.875rem;color:var(--text-light);margin:0;font-weight:var(--font-weight-semibold);">На встрече не выполняются:</p>
        <ul style="list-style:none;padding:0;margin:8px 0 0;">
          <li style="padding:4px 0;font-size:0.875rem;color:var(--text-muted);">полноценный аудит</li>
          <li style="padding:4px 0;font-size:0.875rem;color:var(--text-muted);">проектирование готового решения</li>
          <li style="padding:4px 0;font-size:0.875rem;color:var(--text-muted);">подготовка технического задания</li>
          <li style="padding:4px 0;font-size:0.875rem;color:var(--text-muted);">анализ кода</li>
          <li style="padding:4px 0;font-size:0.875rem;color:var(--text-muted);">детальная оценка сложной интеграции</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Обследование и архитектура -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Обследование и архитектура</h2>
    </div>
    <div class="solution-card animate-on-scroll">
      <h3 style="margin-bottom:12px;">Результаты:</h3>
      <ul style="list-style:none;padding:0;margin:0;">
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ описание текущего состояния</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ карта процессов и систем</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ требования</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ целевая архитектура</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ схема интеграций</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ этапы</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);border-bottom:1px solid var(--border);">→ риски</li>
        <li style="padding:8px 0;font-size:0.9375rem;color:var(--text-light);">→ оценка сроков и бюджета</li>
      </ul>
    </div>
  </div>
</section>

<!-- Внедрение -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Внедрение</h2>
    </div>
    <div class="process-steps">
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">1</div>
        <div class="process-step__content">
          <h4>Планирование</h4>
          <p>Согласование сроков, ресурсов и последовательности работ.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">2</div>
        <div class="process-step__content">
          <h4>Настройка и разработка</h4>
          <p>Реализация согласованной системы или отдельного функционального контура.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">3</div>
        <div class="process-step__content">
          <h4>Демонстрации</h4>
          <p>Показ промежуточных результатов на каждом этапе.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">4</div>
        <div class="process-step__content">
          <h4>Тестирование</h4>
          <p>Проверка функционала, интеграций и сценариев использования.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">5</div>
        <div class="process-step__content">
          <h4>Обучение</h4>
          <p>Подготовка пользователей к работе с новой системой.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">6</div>
        <div class="process-step__content">
          <h4>Запуск</h4>
          <p>Вывод системы в эксплуатацию и передача управления.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Миграция и перезапуск -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Миграция и перезапуск</h2>
    </div>
    <div class="process-steps">
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">1</div>
        <div class="process-step__content">
          <h4>Аудит источников</h4>
          <p>Изучаем существующие системы и данные для переноса.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">2</div>
        <div class="process-step__content">
          <h4>Очистка данных</h4>
          <p>Удаление дубликатов, исправление ошибок, приведение к единому формату.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">3</div>
        <div class="process-step__content">
          <h4>Тестовый перенос</h4>
          <p>Первичный перенос данных в тестовое окружение для проверки.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">4</div>
        <div class="process-step__content">
          <h4>Основной перенос</h4>
          <p>Перенос данных в рабочую систему с минимальным простоем.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">5</div>
        <div class="process-step__content">
          <h4>Проверка</h4>
          <p>Валидация полноты и корректности перенесённых данных.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">6</div>
        <div class="process-step__content">
          <h4>Переход на новую систему</h4>
          <p>Переключение пользователей и запуск новой системы в работу.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Сопровождение -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Сопровождение</h2>
    </div>
    <div class="format-grid grid grid--2">
      <div class="format-card animate-on-scroll">
        <h4 class="format-card__title">Регламент обработки обращений</h4>
        <p class="format-card__desc">Чёткие процедуры для обработки запросов пользователей и инцидентов.</p>
      </div>
      <div class="format-card animate-on-scroll">
        <h4 class="format-card__title">Зоны ответственности</h4>
        <p class="format-card__desc">Определение ролей и ответственности за каждый компонент системы.</p>
      </div>
      <div class="format-card animate-on-scroll">
        <h4 class="format-card__title">Поддержка</h4>
        <p class="format-card__desc">Консультации пользователей, исправление ошибок, оперативные доработки.</p>
      </div>
      <div class="format-card animate-on-scroll">
        <h4 class="format-card__title">Контроль интеграций</h4>
        <p class="format-card__desc">Мониторинг обмена данными между системами, обработка ошибок.</p>
      </div>
      <div class="format-card animate-on-scroll">
        <h4 class="format-card__title">Обновления</h4>
        <p class="format-card__desc">Плановое обновление платформы, компонентов и интеграций.</p>
      </div>
      <div class="format-card animate-on-scroll">
        <h4 class="format-card__title">Развитие</h4>
        <p class="format-card__desc">Поэтапное расширение функциональности системы по мере роста бизнеса.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Обсудим формат проекта</h2>
      <p class="cta-section__desc">Расскажите о вашей задаче. Определим, какой формат работы подходит — от Qualification call до полного сопровождения.</p>
      <a href="/project/" class="btn btn-accent">Обсудить формат проекта</a>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
