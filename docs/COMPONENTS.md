# Переиспользуемые компоненты Dianomi

## 🎨 UI-компоненты

### Кнопки

#### .btn (базовая)
```html
<button class="btn">Текст кнопки</button>
<a href="#" class="btn">Ссылка-кнопка</a>
```

**Стили:**
- Padding: 14px 28px
- Font size: 1rem
- Font weight: 600
- Border radius: 8px
- Transition: all 0.3s ease

#### .btn-accent
```html
<button class="btn btn-accent">Обсудить проект</button>
```

**Цвета:**
- Background: #E67E22
- Color: #FFF
- Border: 2px solid #E67E22
- Box-shadow: 0 4px 16px rgba(230,126,34,0.3)

**Hover:**
- Background: #D35400
- Transform: translateY(-1px)
- Box-shadow: 0 6px 20px rgba(230,126,34,0.35)

#### .btn-primary
```html
<button class="btn btn-primary">Подробнее</button>
```

**Цвета:**
- Background: #2A5B9A
- Color: #FFF
- Border: 2px solid #2A5B9A

#### .btn-outline
```html
<button class="btn btn-outline">Сравнить тарифы</button>
```

**Цвета:**
- Background: transparent
- Color: #2A5B9A
- Border: 2px solid #2A5B9A

**Hover:**
- Background: #2A5B9A
- Color: #FFF

#### Модификаторы
- `.btn-sm` — уменьшенная (10px 20px, font-size: 0.875rem)
- `.btn-full` — ширина 100%

---

### Карточки

#### .solution-card
```html
<div class="solution-card">
  <div class="solution-card__icon">🎯</div>
  <h3 class="solution-card__title">Заголовок</h3>
  <p class="solution-card__desc">Описание</p>
</div>
```

**Структура:**
- Icon: 48x48px, background: primary
- Title: h3, font-size: 1.25rem
- Description: p, font-size: 0.9375rem

**Использование:**
- Главная (основные направления)
- Битрикс24 (возможности)
- 1С-Битрикс (продукты)

#### .problem-card
```html
<div class="problem-card">Текст карточки</div>
```

**Стили:**
- Background: #F8F9FA
- Border radius: 8px
- Padding: 16px
- Text-align: center

**Использование:**
- Сценарии проекта
- Проблемы клиентов
- Интеграции

#### .format-card
```html
<div class="format-card">
  <h4 class="format-card__title">Заголовок</h4>
  <p class="format-card__desc">Описание</p>
</div>
```

**Использование:**
- Сопровождение Битрикс24
- Форматы работы

#### .edition-card (тарифы)
```html
<div class="edition-card">
  <h3 class="edition-card__name">Название</h3>
  <div class="edition-card__price">Цена</div>
  <div class="edition-card__price-period">в год</div>
  <ul class="edition-card__features">
    <li>Функция 1</li>
    <li>Функция 2</li>
  </ul>
</div>
```

**Модификатор:**
- `.edition-card--featured` — выделенная карточка

**Использование:**
- Тарифы 1С-Битрикс

---

### Формы

#### .form-group
```html
<div class="form-group">
  <label for="name">Имя <span class="required">*</span></label>
  <input type="text" id="name" class="form-control" required>
</div>
```

#### .form-control
```html
<input type="text" class="form-control" placeholder="Введите имя">
<select class="form-control">
  <option>Вариант 1</option>
</select>
<textarea class="form-control"></textarea>
```

**Стили:**
- Padding: 12px 16px
- Border: 1px solid #E0E4E8
- Border radius: 8px
- Font size: 1rem

**States:**
- Focus: border-color: #2A5B9A, box-shadow: 0 0 0 3px rgba(42,91,154,0.12)
- Error: border-color: #E74C3C

#### .form-control--error
```html
<input type="text" class="form-control form-control--error">
```

---

### Сетки

#### .grid
```html
<div class="grid grid--2">
  <div>Карточка 1</div>
  <div>Карточка 2</div>
</div>
```

**Модификаторы:**
- `.grid--2` — 2 колонки
- `.grid--3` — 3 колонки
- `.grid--4` — 4 колонки

**Мобильная адаптация:**
- До 960px: 1 колонка
- 961px+: заданное количество колонок

#### .solution-grid
```html
<div class="solution-grid grid grid--3">
  <div class="solution-card">...</div>
</div>
```

#### .problem-grid
```html
<div class="problem-grid">
  <div class="problem-card">Текст</div>
</div>
```

---

### Заголовки секций

#### .section-heading
```html
<div class="section-heading">
  <h2 class="section-heading__title">Заголовок секции</h2>
  <p class="section-heading__subtitle">Подзаголовок (опционально)</p>
</div>
```

**Использование:**
- Перед каждой секцией контента

---

### CTA-секции

#### .cta-section
```html
<section class="section">
  <div class="container">
    <div class="cta-section">
      <h2 class="cta-section__title">Заголовок</h2>
      <p class="cta-section__desc">Описание</p>
      <a href="#" class="btn btn-accent">CTA</a>
    </div>
  </div>
</section>
```

**Стили:**
- Background: #FFF
- Border radius: 8px
- Padding: 48px 24px
- Text-align: center

**Использование:**
- Финальный CTA на каждой странице

---

### Хлебные крошки

#### .breadcrumbs
```html
<nav class="breadcrumbs" aria-label="Хлебные крошки">
  <div class="container">
    <ul class="breadcrumbs__list">
      <li><a href="index.html">Главная</a></li>
      <li><span class="breadcrumbs__separator">/</span></li>
      <li><a href="#">Платформы</a></li>
      <li><span class="breadcrumbs__separator">/</span></li>
      <li><span class="breadcrumbs__current">Битрикс24</span></li>
    </ul>
  </div>
</nav>
```

---

### Блок контактов

#### .contact-block
```html
<div class="contact-block">
  <div class="contact-block__item">
    <div class="contact-block__icon">📞</div>
    <div class="contact-block__text">
      <a href="tel:+738520000000">+7 (3852) 000-00-00</a>
    </div>
  </div>
  <div class="contact-block__item">
    <div class="contact-block__icon">✉️</div>
    <div class="contact-block__text">
      <a href="mailto:info@dianomi.ru">info@dianomi.ru</a>
    </div>
  </div>
  <div class="contact-block__item">
    <div class="contact-block__icon">📍</div>
    <div class="contact-block__text">
      <span>г. Барнаул</span>
    </div>
  </div>
</div>
```

**Использование:**
- Подвал сайта
- Контакты

---

### Таблицы

#### .comparison-table
```html
<div style="overflow-x:auto;">
  <table class="comparison-table">
    <thead>
      <tr>
        <th>Критерий</th>
        <th>Облако</th>
        <th>Коробка</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Размещение</td>
        <td>Инфраструктура поставщика</td>
        <td>Собственный сервер</td>
      </tr>
    </tbody>
  </table>
</div>
```

**Мобильная адаптация:**
- overflow-x: auto

**Использование:**
- Сравнение облако vs коробка
- Сравнение тарифов

#### .result-table
```html
<table class="result-table">
  <thead>
    <tr>
      <th>Параметр</th>
      <th>До</th>
      <th>После</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Скорость</td>
      <td>2 сек</td>
      <td>0.5 сек</td>
    </tr>
  </tbody>
</table>
```

---

### Этапы работы

#### .process-steps
```html
<div class="process-steps">
  <div class="process-step">
    <div class="process-step__number">1</div>
    <h4 class="process-step__title">Заголовок</h4>
    <p class="process-step__desc">Описание</p>
  </div>
  <!-- ... -->
</div>
```

**Использование:**
- Подход Dianomi (8 этапов)
- Этапы внедрения

---

### Уведомление о cookies

#### .cookie-notice
```html
<div class="cookie-notice">
  <div class="cookie-notice__content">
    <p>Мы используем cookies для улучшения работы сайта.</p>
    <button class="cookie-notice__accept">Принять</button>
    <a href="#">Подробнее</a>
  </div>
</div>
```

**Стили:**
- Position: fixed
- Bottom: 0
- Left: 0
- Right: 0
- Background: #2D3142
- Color: #FFF

**Классы:**
- `.cookie-notice--visible` — показывать уведомление

**Логика:**
- localStorage: `dianomi_cookies_accepted`
- Показывается, если cookie не установлен

---

### Сообщение об успехе

#### .success-message
```html
<div class="success-message">
  <div class="success-message__icon">✅</div>
  <h2 class="success-message__title">Заявка отправлена!</h2>
  <p class="success-message__desc">Мы свяжемся с вами в ближайшее время</p>
</div>
```

**Использование:**
- Страница success.html

---

## 🧩 Структурные компоненты

### Header

**Файл:** `partials/header.html`

**Элементы:**
- Логотип (ссылка на главную)
- МегамENU (3 раздела)
- CTA-кнопка
- Бургер-меню (мобильная версия)

**Структура:**
```html
<header class="header" id="header">
  <div class="container header__inner">
    <a href="index.html" class="header__logo">...</a>
    <nav class="header__nav">...</nav>
    <div class="header__cta">...</div>
    <button class="burger" id="burger">...</button>
  </div>
</header>
```

---

### Footer

**Файл:** `partials/footer.html`

**Элементы:**
- Бренд (логотип, описание, контакты)
- 5 колонок ссылок
- Копирайт

**Структура:**
```html
<footer class="footer">
  <div class="container">
    <div class="footer__inner">
      <div class="footer__brand">...</div>
      <div>Решения</div>
      <div>Платформы</div>
      <div>Интеграции</div>
      <div>Dianomi</div>
      <div>Документы</div>
    </div>
    <div class="footer__copyright">...</div>
  </div>
</footer>
```

---

### Mobile Menu

**Структура:**
```html
<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="mobile-menu" id="mobileMenu">
  <ul class="mobile-menu__list">
    <li class="mobile-menu__item"><a href="...">Главная</a></li>
    <li class="mobile-menu__item mobile-menu__dropdown">
      <button class="mobile-menu__dropdown-btn">
        <span>Решения</span>
        <span class="mobile-menu__dropdown-icon">▾</span>
      </button>
      <ul class="mobile-menu__dropdown-list" style="display:none;">
        <li><a href="...">Системы управления</a></li>
      </ul>
    </li>
    <!-- ... -->
  </ul>
  <div class="mobile-menu__cta">...</div>
  <div class="mobile-menu__contacts">...</div>
</nav>
```

---

### Skip Link

```html
<a href="#main-content" class="sr-only">Перейти к основному содержанию</a>
```

**Класс:**
```css
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border: 0;
}
```

---

## 🎨 Утилиты

### Отступы

```css
.mb-0 { margin-bottom: 0; }
.mb-8 { margin-bottom: 8px; }
.mb-12 { margin-bottom: 12px; }
.mb-16 { margin-bottom: 16px; }
.mb-24 { margin-bottom: 24px; }
.mb-48 { margin-bottom: 48px; }

.text-center { text-align: center; }
.text-muted { color: var(--text-muted); }
```

### Flexbox утилиты

```css
.d-flex { display: flex; }
.align-center { align-items: center; }
.justify-center { justify-content: center; }
.gap-8 { gap: 8px; }
.gap-16 { gap: 16px; }
```

---

## 📱 Адаптивные компоненты

### МегамENU

**Desktop (961px+):**
- Hover-эффект
- 4 колонки
- Opacity transition

**Mobile (до 960px):**
- Click-эффект
- 1 колонка
- Opacity toggle

### Таблицы

**Desktop:**
- display: table
- Width: 100%

**Mobile:**
- display: block
- overflow-x: auto

### Карточки

**Desktop:**
- Grid: 2-3 колонки

**Mobile:**
- Grid: 1 колонка

---

## 🎯 Паттерны использования

### Pattern 1: Hero + Cards + CTA

```html
<section class="page-hero">...</section>
<section class="section">
  <div class="section-heading">
    <h2>Заголовок</h2>
  </div>
  <div class="grid grid--3">
    <div class="solution-card">...</div>
  </div>
</section>
<section class="section">
  <div class="cta-section">
    <h2>CTA</h2>
    <a href="#" class="btn btn-accent">CTA</a>
  </div>
</section>
```

### Pattern 2: Hero + Table + CTA

```html
<section class="page-hero">...</section>
<section class="section">
  <div class="section-heading">
    <h2>Заголовок</h2>
  </div>
  <div style="overflow-x:auto;">
    <table class="comparison-table">...</table>
  </div>
</section>
<section class="section">
  <div class="cta-section">...</div>
</section>
```

### Pattern 3: Hero + Form

```html
<section class="page-hero">...</section>
<section class="section">
  <form id="projectForm">
    <div class="form-group">...</div>
    <button type="submit" class="btn btn-accent">Отправить</button>
  </form>
</section>
```

---

## 📦 Зависимости компонентов

### CSS
- Все стили в `css/style.css`
- Нет внешних CSS-фреймворков

### JS
- Мобильное меню: `initMobileMenu()`
- МегамENU: `initMegaMenu()`
- Формы: валидация + динамические поля
- Анимации: Intersection Observer
- Cookies: localStorage

### Изображения
- SVG для логотипов
- Emoji для иконок
- Нет внешних изображений

---

## 🔧 Кастомизация

### Изменение цветов

```css
:root {
  --primary: #2A5B9A;      /* Основной цвет */
  --accent: #E67E22;       /* Акцентный цвет */
  --bg: #F8F9FA;           /* Фон */
  --text: #2D3142;         /* Текст */
}
```

### Изменение размеров

```css
:root {
  --section-gap: 72px;     /* Отступ между секциями */
  --inner-gap: 24px;       /* Внутренние отступы */
  --card-radius: 8px;      /* Скругление карточек */
}
```

### Добавление нового компонента

1. Добавить CSS-класс в `css/style.css`
2. Добавить HTML-разметку в partials или страницу
3. Добавить JS-логику в `js/main.js` (если нужно)

---

## 📋 Чек-лист использования компонентов

- [ ] Использовать семантические теги (section, nav, main)
- [ ] Добавлять aria-label для навигации
- [ ] Использовать BEM-подобную нотацию
- [ ] Проверять адаптивность
- [ ] Тестировать на мобильных устройствах
- [ ] Убедиться в доступности (a11y)
- [ ] Проверить hover-эффекты
- [ ] Проверить focus-состояния
