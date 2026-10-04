# Архитектура сайта Dianomi

## 🏗️ Общая архитектура

```
┌─────────────────────────────────────────────────────────┐
│                    STATIC SITE                          │
│                                                         │
│  HTML (19 страниц) + CSS + JS + Images                  │
│                                                         │
│  ├── css/style.css          # Дизайн-система           │
│  ├── js/main.js             # Вся логика               │
│  ├── img/                   # Изображения              │
│  └── partials/              # Переиспользуемые блоки    │
│      ├── header.html        # Шапка (мегамENU)         │
│      └── footer.html        # Подвал                   │
└─────────────────────────────────────────────────────────┘
```

---

## 📂 Структура страниц

### Навигационная структура

```
Главная (/)
├── Решения
│   ├── Системы управления бизнесом (/business-systems/)
│   ├── Веб-системы (/web-systems/)
│   ├── Интеграции (/integrations/)
│   ├── Данные и BI-аналитика (/data-bi/)
│   └── ИИ и чат-боты (/ai-bots/)
├── Платформы
│   ├── Битрикс24 (/bitrix24/)
│   │   └── Тарифы (/bitrix24-prices/)
│   └── 1С-Битрикс (/1c-bitrix/)
├── Кейсы (/cases/)
├── Как работаем (/approach/)
├── О Dianomi (/about/)
├── Обсудить проект (/project/)
└── Контакты (/contacts/)

Юридические
├── Политика конфиденциальности (/privacy/)
├── Согласие на обработку ПД (/personal-data/)
├── Реквизиты (/license/)
├── Страница успешной отправки (/success/)
└── Страница 404 (/404/)
```

---

## 🎯 Маршруты пользователей

### 6 основных маршрутов

1. **Управление бизнесом**
   ```
   Главная → Решения → Системы управления бизнесом → Обсудить проект
   ```

2. **Создание сайта**
   ```
   Главная → Решения → Веб-системы → Обсудить проект
   ```

3. **Интеграции**
   ```
   Главная → Решения → Интеграции → Обсудить проект
   ```

4. **Изучение Битрикс24**
   ```
   Главная → Платформы → Битрикс24 → Тарифы → Обсудить проект
   ```

5. **Изучение 1С-Битрикс**
   ```
   Главная → Платформы → 1С-Битрикс → Тарифы → Обсудить проект
   ```

6. **Доверие**
   ```
   Главная → Кейсы → О компании → Как работаем → Обсудить проект
   ```

---

## 🧩 Компоненты

### Header (Шапка)

**Файл:** `partials/header.html`

**Элементы:**
- Логотип (ссылка на главную)
- МегамENU (3 раздела):
  - Решения (dropdown)
  - Платформы (dropdown)
  - Интеграции (dropdown)
- CTA-кнопка «Обсудить проект»
- Бургер-меню (мобильная версия)

**Мобильное меню:**
- Выпадающий список
- Аккордеон для подменю
- Overlay (затемнение фона)

---

### Footer (Подвал)

**Файл:** `partials/footer.html`

**Элементы:**
- Бренд (логотип, описание, контакты)
- 5 колонок ссылок:
  - Решения (5 ссылок)
  - Платформы (5 ссылок)
  - Интеграции (4 ссылки)
  - Dianomi (5 ссылок)
  - Документы (3 ссылки)
- Копирайт

---

## 🎨 CSS-архитектура

### Файл: `css/style.css`

**Блоки:**
1. CSS-переменные (дизайн-токены)
2. Reset & Base
3. Layout (container, grid)
4. Typography
5. UI Kit (кнопки, карточки, формы)
6. Компоненты (16 компонентов)
7. Media queries (600px, 960px, 1200px)

**CSS-компоненты:**
- `arch-diagram` — схема связанных систем
- `comparison-table` — сравнение облако vs коробка
- `result-table` — таблица до/после
- `process-steps` — этапы работы
- `solution-card` — карточка направления
- `problem-card` — карточка проблемы
- `format-card` — формат работы
- `platform-card` — карточка платформы
- `integration-card` — карточка интеграции
- `cta-section` — финальный CTA-блок
- `case-card-nov` — карточка кейса
- `breadcrumbs` — хлебные крошки
- `section-heading` — заголовок секции
- `contact-block` — блок контактов
- `cookie-notice` — уведомление о cookies
- `success-message` — сообщение об успехе

---

## ⚙️ JavaScript-архитектура

### Файл: `js/main.js`

**Модули:**

1. **Mobile Menu**
   - `openMenu()` — открыть меню
   - `closeMenu()` — закрыть меню
   - `initMobileMenu()` — инициализация

2. **Mobile Dropdowns**
   - `initDropdown()` — аккордеон для подменю

3. **Mega Menu**
   - `initMegaMenu()` — десктоп hover + мобильный click

4. **Header Scroll**
   - `onScrollHeader()` — уменьшение шапки при скролле

5. **Smooth Scroll**
   - Плавная прокрутка к якорям

6. **Project Form**
   - Динамические поля
   - Валидация
   - Отправка → success.html

7. **FAQ Accordion**
   - Раскрытие/скрытие ответов

8. **Phone Mask**
   - Маска +7 (XXX) XXX-XX-XX

9. **Scroll Animations**
   - Intersection Observer

10. **Cookie Notice**
    - Уведомление о cookies

---

## 📄 Структура HTML-страниц

### Базовая структура

```html
<!DOCTYPE html>
<html lang="ru">
<head>
  <!-- Метаданные -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>...</title>
  <meta name="description" content="...">
  <meta property="og:..." content="...">
  <link rel="canonical" href="...">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Header (встроен) -->
  <header class="header" id="header">...</header>
  
  <!-- Mobile overlay -->
  <div class="mobile-overlay" id="mobileOverlay"></div>
  
  <!-- Mobile menu -->
  <nav class="mobile-menu" id="mobileMenu">...</nav>
  
  <!-- Skip link -->
  <a href="#main-content" class="sr-only">...</a>
  
  <!-- Breadcrumbs -->
  <nav class="breadcrumbs">...</nav>
  
  <!-- Main content -->
  <main id="main-content">
    <!-- Page Hero -->
    <section class="page-hero">...</section>
    
    <!-- Секции контента -->
    <section class="section">...</section>
    <section class="section section--alt">...</section>
    
    <!-- CTA -->
    <section class="section">
      <div class="cta-section">...</div>
    </section>
  </main>
  
  <!-- Footer (встроен) -->
  <footer class="footer">...</footer>
  
  <!-- Scripts -->
  <script src="js/main.js"></script>
  
  <!-- JSON-LD -->
  <script type="application/ld+json">...</script>
</body>
</html>
```

---

## 🔗 Внутренние ссылки

### Ключевые переходы

| Со страницы | На страницу | Контекст |
|------------|-------------|----------|
| Главная | Все страницы | Навигация |
| Бизнес-системы | Обсудить проект | CTA |
| Веб-системы | Обсудить проект | CTA |
| Битрикс24 | Тарифы | Ссылка «Сравнить тарифы» |
| Битрикс24 | Обсудить проект | CTA |
| 1С-Битрикс | Тарифы (#tariffs) | Якорь |
| 1С-Битрикс | Обсудить проект | CTA |
| Проект | Success | Отправка формы |

---

## 📊 SEO-структура

### Метаданные

**Обязательные элементы на каждой странице:**
- `<title>` — уникальный
- `<meta description>` — уникальный
- `<link rel="canonical">` — канонический URL
- Open Graph теги (og:title, og:description, og:image, og:url)
- JSON-LD микроразметка (Service, BreadcrumbList)

### Хлебные крошки

**Структура:**
```
Главная / Платформы / Битрикс24
Главная / Решения / Интеграции
Главная / Dianomi / О компании
```

---

## 🎯 Целевые действия

### CTA-элементы

1. **«Обсудить проект»** → `/project.html`
   - В header
   - В каждой секции CTA
   - В подвале

2. **«Сравнить тарифы»** → `/bitrix24-prices.html`
   - На странице Битрикс24

3. **Форма на `/project.html`**
   - Динамические поля
   - Валидация
   - Переход на success.html

---

## 📱 Адаптивность

### Breakpoints

```css
/* Мобильные */
@media (max-width: 600px) { ... }

/* Планшеты */
@media (min-width: 601px) and (max-width: 960px) { ... }

/* Десктоп */
@media (min-width: 961px) { ... }
```

### Адаптивные компоненты

| Компонент | Мобильный | Десктоп |
|-----------|-----------|---------|
| Grid | 1 колонка | 2-3 колонки |
| Table | overflow-x: auto | display: table |
| Header | Бургер-меню | МегамENU |
| Cards | 1 колонка | 2-3 колонки |

---

## 🔐 Безопасность

### Текущие меры
- HTTPS (при публикации)
- Политика конфиденциальности
- Согласие на обработку ПД
- Cookie notice

### Что нужно добавить перед публикацией
- SSL-сертификат
- robots.txt (уже есть)
- sitemap.xml (уже есть)
- HSTS заголовки
- CSP заголовки

---

## 📈 Производительность

### Оптимизации
- Минимальное количество HTTP-запросов
- Google Fonts с preconnect
- CSS в одном файле
- JS в одном файле
- SVG-изображения

### Что можно улучшить
- Сжатие изображений
- Lazy loading для изображений
- Минификация CSS/JS
- Кэширование

---

## 🧪 Тестирование

### Браузеры
- Chrome (основной)
- Firefox
- Safari
- Edge

### Устройства
- iPhone (375px)
- Android (360px-412px)
- iPad (768px)
- Desktop (1200px+)

### Чек-лист
- [ ] Header отображается корректно
- [ ] Мобильное меню открывается/закрывается
- [ ] МегамENU работает на десктопе
- [ ] Формы валидируются
- [ ] Анимации работают
- [ ] Таблицы адаптивны
- [ ] Все ссылки работают
- [ ] Метаданные уникальны
- [ ] JSON-LD валиден
