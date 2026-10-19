<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Korobochnyy Bitrix24');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Коробочный Битрикс24 — полный контроль над инфраструктурой</h1>
    <p class="page-hero__subtitle">Размещаете систему на собственных серверах: контролируете безопасность, интегрируете с внутренними системами, кастомизируете под уникальные процессы. Для компаний, которым нужен закрытый контур и глубокая настройка.</p>
    <div style="margin-top:24px;display:flex;gap:12px;flex-wrap:wrap;">
      <a href="/project/" class="btn btn-accent">Обсудить коробочный Битрикс24</a>
      <a href="/bitrix24/" class="btn btn-outline">Сравнить с облаком</a>
    </div>
  </div>
</section>

<!-- Когда нужен коробочный -->
<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Когда нужен коробочный Битрикс24</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Если хотя бы один сценарий про вас — коробочная версия будет оптимальным выбором</p>
    </div>
    <div class="grid grid--3">
      <div class="problem-card animate-on-scroll">
        <div style="font-size:2rem;margin-bottom:8px;">🔒</div>
        <strong>Требования к безопасности</strong>
        <p style="margin-top:8px;font-size:0.9375rem;color:var(--text-light);">Персональные данные сотрудников и клиентов должны храниться на собственных серверах</p>
      </div>
      <div class="problem-card animate-on-scroll">
        <div style="font-size:2rem;margin-bottom:8px;">🔗</div>
        <strong>Интеграция с внутренними системами</strong>
        <p style="margin-top:8px;font-size:0.9375rem;color:var(--text-light);">Нужна прямая интеграция с 1С, ERP, складскими и производственными системами</p>
      </div>
      <div class="problem-card animate-on-scroll">
        <div style="font-size:2rem;margin-bottom:8px;">⚙️</div>
        <strong>Глубокая кастомизация</strong>
        <p style="margin-top:8px;font-size:0.9375rem;color:var(--text-light);">Требуется доступ к исходному коду для доработки логики под уникальные процессы</p>
      </div>
      <div class="problem-card animate-on-scroll">
        <div style="font-size:2rem;margin-bottom:8px;">🏢</div>
        <strong>Закрытый контур</strong>
        <p style="margin-top:8px;font-size:0.9375rem;color:var(--text-light);">Работа в условиях, где доступ извне ограничен — оборонка, госсектор, финансы</p>
      </div>
      <div class="problem-card animate-on-scroll">
        <div style="font-size:2rem;margin-bottom:8px;">📈</div>
        <strong>Контроль производительности</strong>
        <p style="margin-top:8px;font-size:0.9375rem;color:var(--text-light);">Большое количество пользователей и нужна гарантия производительности</p>
      </div>
      <div class="problem-card animate-on-scroll">
        <div style="font-size:2rem;margin-bottom:8px;">🔄</div>
        <strong>Управление обновлениями</strong>
        <p style="margin-top:8px;font-size:0.9375rem;color:var(--text-light);">Обновления должны проводиться по вашему графику, а не по расписанию поставщика</p>
      </div>
    </div>
  </div>
</section>

<!-- Что входит -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Что входит в коробочный Битрикс24</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Полный набор возможностей для развёртывания и поддержки системы на ваших серверах</p>
    </div>
    <div class="grid grid--2">
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🖥️</div>
        <h3 class="solution-card__title">Собственное размещение</h3>
        <p class="solution-card__desc">Развёртывание на ваших серверах — в дата-центре или локально. Полный контроль над данными и инфраструктурой.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🛠️</div>
        <h3 class="solution-card__title">Глубокая кастомизация</h3>
        <p class="solution-card__desc">Доступ к исходному коду, возможность доработки любой логики, создание собственных модулей и интеграций.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🔌</div>
        <h3 class="solution-card__title">Интеграции с внутренними системами</h3>
        <p class="solution-card__desc">Прямое подключение к 1С, ERP, CRM, складским и производственным системам без ограничений облака.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">💾</div>
        <h3 class="solution-card__title">Резервное копирование</h3>
        <p class="solution-card__desc">Настраиваете бэкапы по своему графику и политикам. Полный контроль над восстановлением данных.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">🔄</div>
        <h3 class="solution-card__title">Управление обновлениями</h3>
        <p class="solution-card__desc">Обновляете платформу по своему графику, тестируете изменения перед внедрением в продакшн.</p>
      </div>
      <div class="solution-card animate-on-scroll">
        <div class="solution-card__icon">📊</div>
        <h3 class="solution-card__title">Мониторинг и администрирование</h3>
        <p class="solution-card__desc">Полный доступ к логам, метрикам и настройкам сервера. Разграничение ролей и прав доступа.</p>
      </div>
    </div>
  </div>
</section>

<!-- Сравнение с облаком -->
<section class="section" id="compare">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Облако или коробка</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Честное сравнение для принятия решения</p>
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
          <tr><td>Глубокая доработка</td><td>Ограничена возможностями облака</td><td>Доступен исходный код</td></tr>
          <tr><td>Контроль инфраструктуры</td><td>Ограниченный</td><td>Полный</td></tr>
          <tr><td>Закрытый контур</td><td>Не основной сценарий</td><td>Полная поддержка</td></tr>
          <tr><td>Обновления</td><td>Выполняются поставщиком автоматически</td><td>По вашему графику</td></tr>
          <tr><td>Стоимость владения</td><td>Операционные расходы (подписка)</td><td>Капитальные + операционные расходы</td></tr>
          <tr><td>Безопасность данных</td><td>Зависит от инфраструктуры поставщика</td><td>Зависит от вашей организации</td></tr>
        </tbody>
      </table>
    </div>
    <div style="margin-top:20px;padding:16px;background:rgba(42,91,154,0.06);border-radius:var(--card-radius);border-left:3px solid var(--primary);" class="animate-on-scroll">
      <p style="font-size:0.9375rem;color:var(--text-light);margin:0;"><strong>Важно:</strong> Мы не используем утверждение «коробка всегда безопаснее». Безопасность зависит от архитектуры, администрирования и организации доступа — независимо от формата размещения.</p>
    </div>
  </div>
</section>

<!-- Этапы внедрения -->
<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Этапы внедрения</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">От обследования до запуска и поддержки</p>
    </div>
    <div class="animate-on-scroll" style="max-width:720px;margin:0 auto;">
      <div class="process-steps">
        <div class="process-step">
          <div class="process-step__number">1</div>
          <div class="process-step__content">
            <h4>Аудит требований</h4>
            <p>Определяем объём данных, количество пользователей, требования к безопасности и интеграциям</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">2</div>
          <div class="process-step__content">
            <h4>Проектирование инфраструктуры</h4>
            <p>Проектируем архитектуру серверов, сети, резервного копирования и мониторинга</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">3</div>
          <div class="process-step__content">
            <h4>Развёртывание</h4>
            <p>Устанавливаем и настраиваем платформу на ваших серверах</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">4</div>
          <div class="process-step__content">
            <h4>Кастомизация и интеграции</h4>
            <p>Настраиваем модули, разрабатываем кастомные решения, интегрируем с внутренними системами</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">5</div>
          <div class="process-step__content">
            <h4>Тестирование и обучение</h4>
            <p>Проверяем сценарии, обучаем команду, готовим документацию</p>
          </div>
        </div>
        <div class="process-step">
          <div class="process-step__number">6</div>
          <div class="process-step__content">
            <h4>Запуск и сопровождение</h4>
            <p>Выводим систему в эксплуатацию, обеспечиваем поддержку и развитие</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title">Не уверены, облако или коробка?</h2>
      <p class="cta-section__desc">Расскажите о вашей задаче и требованиях. Поможем определить оптимальный формат размещения Битрикс24.</p>
      <div style="margin-top:16px;display:flex;gap:12px;flex-wrap:wrap;justify-content:center;">
        <a href="/project/" class="btn btn-accent">Обсудить проект</a>
        <a href="/bitrix24/" class="btn btn-outline">Вернуться к облачному Битрикс24</a>
      </div>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
