<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Dannye i BI-analitika');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Данные, на основании которых можно управлять</h1>
    <p class="page-hero__subtitle">Объединяем показатели из CRM, 1С, сайтов и других источников в понятной системе управленческой и операционной аналитики.</p>
    <div style="margin-top:24px;">
      <a href="/project/" class="btn btn-accent">Обсудить систему показателей</a>
    </div>
  </div>
</section>

<!-- Когда нужна аналитика -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Когда нужна аналитика</h2>
    </div>
    <div class="problem-grid">
      <div class="problem-card animate-on-scroll">отчёты собираются вручную</div>
      <div class="problem-card animate-on-scroll">сотрудники используют разные цифры</div>
      <div class="problem-card animate-on-scroll">данные находятся в нескольких системах</div>
      <div class="problem-card animate-on-scroll">невозможно быстро оценить продажи и исполнение</div>
      <div class="problem-card animate-on-scroll">руководитель узнаёт о проблемах слишком поздно</div>
    </div>
  </div>
</section>

<!-- Что создаётся -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Что создаётся</h2>
    </div>
    <div class="solution-grid grid grid--2">
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📊</div>
        <h3 class="solution-card__title">Панели руководителя</h3>
        <p class="solution-card__desc">Ключевые показатели бизнеса в реальном времени. Сводная информация по продажам, финансам, операциям.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📈</div>
        <h3 class="solution-card__title">Аналитика продаж</h3>
        <p class="solution-card__desc">Воронки, конверсии, средний чек, динамика. Понимание, что работает, а что требует улучшения.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">⚙️</div>
        <h3 class="solution-card__title">Операционная аналитика</h3>
        <p class="solution-card__desc">Загрузка сотрудников, сроки выполнения, качество обработки обращений, SLA.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📋</div>
        <h3 class="solution-card__title">Проектная аналитика</h3>
        <p class="solution-card__desc">Статус проектов, использование ресурсов, бюджеты, риски и зависимости.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🤝</div>
        <h3 class="solution-card__title">Отчётность по клиентскому сервису</h3>
        <p class="solution-card__desc">Качество обслуживания, время ответа, удовлетворённость, повторные обращения.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🔄</div>
        <h3 class="solution-card__title">Автоматизированные отчёты</h3>
        <p class="solution-card__desc">Регулярная отчётность без ручного сбора данных. Формирование по расписанию.</p>
      </div>
    </div>
  </div>
</section>

<!-- Этапы BI-проекта -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Этапы BI-проекта</h2>
    </div>
    <div class="process-steps">
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">1</div>
        <div class="process-step__content">
          <h4>Определение управленческих вопросов</h4>
          <p>Что нужно знать руководству? Какие решения принимаются на основе данных?</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">2</div>
        <div class="process-step__content">
          <h4>Формирование системы показателей</h4>
          <p>Определяем KPI, метрики и их расчёт для каждого направления бизнеса.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">3</div>
        <div class="process-step__content">
          <h4>Аудит источников</h4>
          <p>Изучаем существующие системы, качество данных, возможности интеграции.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">4</div>
        <div class="process-step__content">
          <h4>Проверка качества данных</h4>
          <p>Оцениваем полноту, точность и актуальность данных из каждого источника.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">5</div>
        <div class="process-step__content">
          <h4>Проектирование модели</h4>
          <p>Создаём структуру данных, связи между показателями и правила расчётов.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">6</div>
        <div class="process-step__content">
          <h4>Создание панелей</h4>
          <p>Визуализация показателей в удобных дашбордах для каждого уровня управления.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">7</div>
        <div class="process-step__content">
          <h4>Проверка расчётов</h4>
          <p>Валидация данных, сравнение с существующей отчётностью, исправление расхождений.</p>
        </div>
      </div>
      <div class="process-step animate-on-scroll">
        <div class="process-step__number">8</div>
        <div class="process-step__content">
          <h4>Ввод в эксплуатацию</h4>
          <p>Обучение пользователей, передача системы, настройка мониторинга.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Важный принцип -->
<section class="section section--alt">
  <div class="container">
    <div class="cta-section animate-on-scroll" style="background:linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);">
      <h3 class="cta-section__title" style="font-size:1.25rem;">Важный принцип</h3>
      <p class="cta-section__desc" style="font-size:1rem;margin:0;">Панель не исправляет некорректные данные. До визуализации необходимо определить источники, правила расчёта и ответственность за качество информации.</p>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Обсудим, какие показатели нужно отслеживать</h2>
      <p class="cta-section__desc">Расскажите о вашей задаче и используемых системах. Определим, какие данные доступны и как их объединить для управленческих решений.</p>
      <a href="/project/" class="btn btn-accent">Обсудить BI-проект</a>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
