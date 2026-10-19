<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Obsudit proekt - Dianomi');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Расскажите о задаче</h1>
    <p class="page-hero__subtitle">Опишите, что требуется создать, связать, исправить или развить. Мы изучим информацию и предложим подходящий следующий шаг.</p>
  </div>
</section>

<!-- Form -->
<section class="section">
  <div class="container">
    <div style="max-width:680px;margin:0 auto;">
      <form id="projectForm" novalidate>
        
        <!-- Обязательные поля -->
        <div style="margin-bottom:24px;">
          <h3 style="font-size:1.125rem;margin-bottom:16px;">Основная информация</h3>
          
          <div class="form-group">
            <label for="fieldName">Имя <span class="required">*</span></label>
            <input type="text" id="fieldName" name="name" class="form-control" placeholder="Ваше имя" required>
          </div>
          
          <div class="form-group">
            <label for="fieldCompany">Компания <span class="required">*</span></label>
            <input type="text" id="fieldCompany" name="company" class="form-control" placeholder="Название компании" required>
          </div>
          
          <div class="form-group">
            <label for="fieldPosition">Должность <span class="required">*</span></label>
            <input type="text" id="fieldPosition" name="position" class="form-control" placeholder="Ваша должность">
          </div>
          
          <div class="form-group">
            <label for="fieldPhone">Телефон <span class="required">*</span></label>
            <input type="tel" id="fieldPhone" name="phone" class="form-control" placeholder="+7 (___) ___-__-__" required>
          </div>
          
          <div class="form-group">
            <label for="fieldEmail">Email или мессенджер <span class="required">*</span></label>
            <input type="text" id="fieldEmail" name="email" class="form-control" placeholder="email@example.com или @telegram">
          </div>
        </div>

        <!-- Тип задачи -->
        <div style="margin-bottom:24px;">
          <h3 style="font-size:1.125rem;margin-bottom:16px;">Тип задачи</h3>
          
          <div class="form-group">
            <label for="projectType">Выберите тип <span class="required">*</span></label>
            <select id="projectType" name="project_type" class="form-control" required>
              <option value="">— Выберите тип задачи —</option>
              <option value="bitrix24">Внедрение Битрикс24</option>
              <option value="on-premise">Коробочный Битрикс24</option>
              <option value="web-system">Веб-система на 1С-Битрикс</option>
              <option value="integration">Интеграция</option>
              <option value="bi">BI-аналитика</option>
              <option value="ai">ИИ или чат-бот</option>
              <option value="audit">Аудит и перезапуск</option>
              <option value="support">Сопровождение</option>
              <option value="other">Другое</option>
            </select>
          </div>
        </div>

        <!-- Описание задачи -->
        <div style="margin-bottom:24px;">
          <h3 style="font-size:1.125rem;margin-bottom:16px;">Описание задачи</h3>
          
          <div class="form-group">
            <label for="fieldDescription">Опишите задачу <span class="required">*</span></label>
            <textarea id="fieldDescription" name="description" class="form-control" rows="5" placeholder="Расскажите о вашей задаче, действующих системах и ожидаемом результате" required></textarea>
          </div>
        </div>

        <!-- Дополнительные поля -->
        <div style="margin-bottom:24px;">
          <h3 style="font-size:1.125rem;margin-bottom:16px;">Дополнительно</h3>
          
          <div class="form-group">
            <label for="fieldIndustry">Отрасль</label>
            <input type="text" id="fieldIndustry" name="industry" class="form-control" placeholder="Производство, торговля, услуги...">
          </div>
          
          <div class="form-group">
            <label for="fieldEmployees">Количество сотрудников</label>
            <input type="number" id="fieldEmployees" name="employees" class="form-control" placeholder="Примерное количество">
          </div>
          
          <div class="form-group">
            <label for="fieldSystems">Используемые системы</label>
            <input type="text" id="fieldSystems" name="systems" class="form-control" placeholder="Битрикс24, 1С, сайт...">
          </div>
          
          <div class="form-group">
            <label for="fieldTimeline">Ожидаемый срок</label>
            <select id="fieldTimeline" name="timeline" class="form-control">
              <option value="">— Выберите —</option>
              <option value="1-month">До 1 месяца</option>
              <option value="1-3-months">1–3 месяца</option>
              <option value="3-6-months">3–6 месяцев</option>
              <option value="6+months">Более 6 месяцев</option>
              <option value="flexible">Гибкие сроки</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="fieldBudget">Ориентир по бюджету</label>
            <select id="fieldBudget" name="budget" class="form-control">
              <option value="">— Выберите —</option>
              <option value="under-100k">До 100 000 ₽</option>
              <option value="100-300k">100 000 – 300 000 ₽</option>
              <option value="300-500k">300 000 – 500 000 ₽</option>
              <option value="500k-1m">500 000 – 1 000 000 ₽</option>
              <option value="over-1m">Более 1 000 000 ₽</option>
              <option value="discuss">Обсудим</option>
            </select>
          </div>
        </div>

        <!-- Динамические поля -->
        <div id="dynamicFields" style="margin-bottom:24px;"></div>

        <!-- Согласие -->
        <div class="consent-group" style="margin-bottom:24px;">
          <label>
            <input type="checkbox" name="consent" required>
            <span>Я согласен на <a href="/personal-data/" target="_blank">обработку персональных данных</a></span>
          </label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-accent btn-full" style="padding:16px;font-size:1.0625rem;">Отправить заявку</button>
        
        <p style="font-size:0.8125rem;color:var(--text-muted);text-align:center;margin-top:16px;">
          Мы изучим описание задачи и свяжемся с вами по указанным контактам.
        </p>
      </form>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
