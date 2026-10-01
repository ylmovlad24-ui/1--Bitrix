# Спецификация дизайна Dianomi

## 🎨 Дизайн-система

### Цветовая палитра

```css
/* Основные цвета */
--bg: #F8F9FA              /* Фон страницы */
--bg-alt: #FFFFFF          /* Фон карточек, секций */
--text: #2D3142            /* Основной текст */
--text-light: #5A6275      /* Вторичный текст */
--text-muted: #8E95A9      /* Приглушённый текст */
--text-dark: #1A1D2B       /* Тёмный текст */

/* Акцентные цвета */
--primary: #2A5B9A         /* Основной синий */
--primary-dark: #1E4474    /* Тёмно-синий (hover) */
--primary-light: #3A7BC8   /* Светло-синий */
--accent: #E67E22          /* Акцентный оранжевый */
--accent-dark: #D35400     /* Тёмно-оранжевый (hover) */
--accent-light: #F5A623    /* Светло-оранжевый */

/* Состояния */
--success: #27AE60         /* Успех */
--error: #E74C3C           /* Ошибка */
--border: #E0E4E8          /* Границы */

/* Тени */
--shadow-sm: 0 1px 3px rgba(0,0,0,0.06)
--shadow-md: 0 4px 12px rgba(0,0,0,0.08)
--shadow-lg: 0 8px 24px rgba(0,0,0,0.1)
--shadow-accent: 0 4px 16px rgba(230,126,34,0.3)
```

---

### Типографика

```css
/* Шрифт */
--font-main: 'Inter', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;

/* Вес шрифта */
--font-weight-light: 300
--font-weight-regular: 400
--font-weight-semibold: 600
--font-weight-bold: 700

/* Размеры */
--header-height: 72px
--section-gap: 72px
--inner-gap: 24px
--card-radius: 8px

/* Базовые стили */
font-size: 16px;
line-height: 1.6;
```

#### Заголовки

```css
h1 { font-size: 1.75rem; margin-bottom: 16px; }     /* 28px */
h2 { font-size: 1.5rem; margin-bottom: 12px; }       /* 24px */
h3 { font-size: 1.25rem; margin-bottom: 8px; }       /* 20px */
h4 { font-size: 1rem; margin-bottom: 8px; }          /* 16px */
h5 { font-size: 0.875rem; margin-bottom: 8px; }      /* 14px */
```

---

### Отступы

```css
/* Контейнер */
max-width: 1200px;
padding: 0 24px;

/* Секции */
gap: 72px (десктоп)
gap: 48px (мобильные)

/* Внутренние отступы */
inner-gap: 24px
```

---

## 🎭 UI-компоненты

### Кнопки

#### .btn (базовая)
```css
padding: 14px 28px;
font-size: 1rem;
font-weight: 600;
border-radius: 8px;
transition: all 0.3s ease;
```

#### .btn-primary
```css
background: var(--primary);
color: #FFF;
border: 2px solid var(--primary);
```

#### .btn-accent
```css
background: var(--accent);
color: #FFF;
border: 2px solid var(--accent);
box-shadow: var(--shadow-accent);
```

#### .btn-outline
```css
background: transparent;
color: var(--primary);
border: 2px solid var(--primary);
```

#### Модификаторы
- `.btn-sm` — уменьшенная (10px 20px)
- `.btn-full` — ширина 100%

---

### Карточки

#### .card (базовая)
```css
background: var(--bg-alt);
border: 1px solid var(--border);
border-radius: 8px;
padding: 24px;
transition: all 0.3s ease;
```

**Hover-эффект:**
```css
box-shadow: var(--shadow-md);
transform: translateY(-2px);
```

#### .solution-card
```css
/* Структура */
┌─────────────────────┐
│  🎯 Icon (48x48)    │
│                     │
│  H3 Title           │
│  P Description      │
└─────────────────────┘
```

#### .problem-card
```css
/* Стиль */
background: var(--bg);
border-radius: 8px;
padding: 16px;
text-align: center;
```

#### .format-card
```css
/* Структура */
┌─────────────────────┐
│  H4 Title           │
│  P Description      │
└─────────────────────┘
```

#### .edition-card (тарифы)
```css
/* Структура */
┌─────────────────────┐
│  H3 Name            │
│  Price (bold)       │
│  /period            │
│                     │
│  • Feature 1        │
│  • Feature 2        │
│  • Feature 3        │
└─────────────────────┘
```

---

### Формы

#### .form-group
```css
margin-bottom: 16px;
```

#### .form-control
```css
padding: 12px 16px;
font-size: 1rem;
border: 1px solid var(--border);
border-radius: 8px;
transition: border-color 0.2s ease, box-shadow 0.2s ease;
```

**Focus-состояние:**
```css
border-color: var(--primary);
box-shadow: 0 0 0 3px rgba(42,91,154,0.12);
```

**Error-состояние:**
```css
border-color: var(--error);
```

---

## 📐 Layout

### Container

```css
.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}
```

### Grid

#### .grid
```css
display: grid;
gap: 24px;
```

#### .grid--2
```css
grid-template-columns: repeat(2, 1fr);
```

#### .grid--3
```css
grid-template-columns: repeat(3, 1fr);
```

#### .grid--4
```css
grid-template-columns: repeat(4, 1fr);
```

**Мобильная адаптация:**
```css
@media (max-width: 960px) {
  .grid--2, .grid--3, .grid--4 {
    grid-template-columns: 1fr;
  }
}
```

---

## 🎨 CSS-компоненты (16 штук)

### 1. Architecture Diagram

**Назначение:** Схема связанных систем

**Структура:**
```
[Система A] ──→ [Данные] ──→ [Система B]
      │                   │
      └───────→ [Процессы] ←──────┘
```

**Классы:**
- `.arch-diagram` — контейнер
- `.arch-node` — узел системы
- `.arch-line` — линия связи

---

### 2. Comparison Table

**Назначение:** Сравнение облако vs коробка

**Структура:**
```
┌────────────┬────────────┬────────────┐
│ Критерий   │ Облако     │ Коробка    │
├────────────┼────────────┼────────────┤
│ Размещение │ ...        │ ...        │
│ Запуск     │ ...        │ ...        │
└────────────┴────────────┴────────────┘
```

**Классы:**
- `.comparison-table` — таблица
- `.comparison-table thead` — заголовок
- `.comparison-table tbody` — тело

**Мобильная версия:**
```css
overflow-x: auto;
```

---

### 3. Result Table

**Назначение:** Таблица до/после

**Структура:**
```
┌──────────────────┬────────────┬────────────┐
│ Параметр         │ До         │ После      │
├──────────────────┼────────────┼────────────┤
│ Скорость         │ 2 сек      │ 0.5 сек    │
│ Конверсия        │ 1%         │ 3%         │
└──────────────────┴────────────┴────────────┘
```

---

### 4. Process Steps

**Назначение:** Этапы работы (1-8)

**Структура:**
```
[1] ──→ [2] ──→ [3] ──→ [4]
```

**Классы:**
- `.process-steps` — контейнер
- `.process-step` — шаг
- `.process-step__number` — номер
- `.process-step__title` — заголовок
- `.process-step__desc` — описание

---

### 5. Solution Card

**Назначение:** Карточка направления

**Структура:**
```
┌─────────────────────┐
│  🎯 Icon            │
│                     │
│  H3 Title           │
│  P Description      │
└─────────────────────┘
```

**Классы:**
- `.solution-card` — карточка
- `.solution-card__icon` — иконка (48x48)
- `.solution-card__title` — заголовок
- `.solution-card__desc` — описание

---

### 6. Problem Card

**Назначение:** Карточка проблемы/возможности

**Структура:**
```
┌─────────────────────┐
│  Текст проблемы     │
└─────────────────────┘
```

**Классы:**
- `.problem-card` — карточка
- `.problem-grid` — сетка карточек

---

### 7. Format Card

**Назначение:** Формат работы

**Структура:**
```
┌─────────────────────┐
│  H4 Title           │
│  P Description      │
└─────────────────────┘
```

**Классы:**
- `.format-card` — карточка
- `.format-card__title` — заголовок
- `.format-card__desc` — описание
- `.format-grid` — сетка

---

### 8. Platform Card

**Назначение:** Карточка платформы

**Структура:**
```
┌─────────────────────┐
│  Logo/Icon          │
│                     │
│  Platform Name      │
│  Description        │
│  [CTA Button]       │
└─────────────────────┘
```

---

### 9. Integration Card

**Назначение:** Карточка интеграции

**Структура:**
```
┌─────────────────────┐
│  [Logo A] ─ [Logo B]│
│                     │
│  Integration Name   │
│  Description        │
└─────────────────────┘
```

---

### 10. CTA Section

**Назначение:** Финальный CTA-блок

**Структура:**
```
┌─────────────────────────────┐
│                             │
│  H2 Title                   │
│  P Description              │
│                             │
│  [CTA Button]               │
│                             │
└─────────────────────────────┘
```

**Классы:**
- `.cta-section` — секция
- `.cta-section__title` — заголовок
- `.cta-section__desc` — описание

**Стили:**
```css
background: var(--bg-alt);
border-radius: 8px;
padding: 48px 24px;
text-align: center;
```

---

### 11. Case Card

**Назначение:** Карточка кейса

**Структура:**
```
┌─────────────────────┐
│  Industry           │
│  Problem            │
│  Solution           │
│  Platforms          │
│  Result             │
└─────────────────────┘
```

**Классы:**
- `.case-card-nov` — карточка
- `.case-card__industry` — отрасль
- `.case-card__problem` — проблема
- `.case-card__solution` — решение
- `.case-card__result` — результат

---

### 12. Breadcrumbs

**Назначение:** Хлебные крошки

**Структура:**
```
Главная / Платформы / Битрикс24
```

**Классы:**
- `.breadcrumbs` — контейнер
- `.breadcrumbs__list` — список
- `.breadcrumbs__separator` — разделитель (/)
- `.breadcrumbs__current` — текущая страница

---

### 13. Section Heading

**Назначение:** Заголовок секции

**Структура:**
```
┌─────────────────────────┐
│                         │
│  H2 Title               │
│  P Subtitle (optional)  │
│                         │
└─────────────────────────┘
```

**Классы:**
- `.section-heading` — контейнер
- `.section-heading__title` — заголовок
- `.section-heading__subtitle` — подзаголовок

---

### 14. Contact Block

**Назначение:** Блок контактов

**Структура:**
```
┌─────────────────────┐
│  📞 +7 (3852) ...   │
│  ✉️ info@dianomi.ru │
│  📍 г. Барнаул      │
└─────────────────────┘
```

**Классы:**
- `.contact-block` — контейнер
- `.contact-block__item` — элемент
- `.contact-block__icon` — иконка
- `.contact-block__text` — текст

---

### 15. Cookie Notice

**Назначение:** Уведомление о cookies

**Структура:**
```
┌─────────────────────────────────┐
│  Мы используем cookies          │
│  [Принять] [Подробнее]          │
└─────────────────────────────────┘
```

**Классы:**
- `.cookie-notice` — уведомление
- `.cookie-notice--visible` — видимое
- `.cookie-notice__accept` — кнопка принятия

**Позиционирование:**
```css
position: fixed;
bottom: 0;
left: 0;
right: 0;
```

---

### 16. Success Message

**Назначение:** Сообщение об успехе

**Структура:**
```
┌─────────────────────┐
│                     │
│  ✅ Заявка          │
│  отправлена!        │
│                     │
│  Мы свяжемся с вами │
│  в ближайшее время  │
│                     │
└─────────────────────┘
```

**Классы:**
- `.success-message` — сообщение
- `.success-message__icon` — иконка
- `.success-message__title` — заголовок
- `.success-message__desc` — описание

---

## 📱 Media Queries

### Mobile (до 600px)

```css
@media (max-width: 600px) {
  /* Базовые стили для мобильных */
  h1 { font-size: 1.5rem; }
  h2 { font-size: 1.25rem; }
  
  /* Grid в 1 колонку */
  .grid--2, .grid--3, .grid--4 {
    grid-template-columns: 1fr;
  }
  
  /* Таблицы с горизонтальным скроллом */
  .comparison-table,
  .result-table {
    display: block;
    overflow-x: auto;
  }
}
```

### Tablet (601px - 960px)

```css
@media (min-width: 601px) and (max-width: 960px) {
  /* 2 колонки */
  .grid--3 {
    grid-template-columns: repeat(2, 1fr);
  }
}
```

### Desktop (961px+)

```css
@media (min-width: 961px) {
  /* 3 колонки */
  .grid--3 {
    grid-template-columns: repeat(3, 1fr);
  }
  
  /* МегамENU */
  .mega-menu {
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
  }
  
  .nav-dropdown:hover .mega-menu {
    opacity: 1;
    visibility: visible;
  }
}
```

---

## 🎯 Анимации

### Scroll Animations

**Intersection Observer:**
```javascript
threshold: 0.12
rootMargin: '0px 0px -40px 0px'
```

**Классы:**
- `.animate-on-scroll` — элемент для анимации
- `.animate-on-scroll--visible` — видимый элемент

**CSS:**
```css
.animate-on-scroll {
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.6s ease;
}

.animate-on-scroll--visible {
  opacity: 1;
  transform: translateY(0);
}
```

### Hover Effects

**Карточки:**
```css
.card:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-2px);
}
```

**Кнопки:**
```css
.btn-accent:hover {
  background-color: var(--accent-dark);
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(230,126,34,0.35);
}
```

---

## 📊 Grid System

### Стандартная сетка

```css
.grid {
  display: grid;
  gap: 24px;
}

.grid--2 {
  grid-template-columns: repeat(2, 1fr);
}

.grid--3 {
  grid-template-columns: repeat(3, 1fr);
}

.grid--4 {
  grid-template-columns: repeat(4, 1fr);
}
```

### Solution Grid

```css
.solution-grid {
  display: grid;
  gap: 24px;
}

.solution-grid.grid--3 {
  grid-template-columns: repeat(3, 1fr);
}
```

### Problem Grid

```css
.problem-grid {
  display: grid;
  gap: 16px;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
}
```

---

## 🎨 Паттерны страниц

### Pattern 1: Page Hero + Sections

**Используется на:** Главная, Битрикс24, 1С-Битрикс, бизнес-системы

```
┌─────────────────────────────────┐
│  Page Hero                      │
│  H1 + Subtitle + CTA            │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  Section (alt)                  │
│  H2 + Content                   │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  Section                        │
│  H2 + Content                   │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  CTA Section                    │
│  H2 + Description + Button      │
└─────────────────────────────────┘
```

### Pattern 2: Page Hero + Cards + CTA

**Используется на:** Веб-системы, Интеграции, AI-боты

```
┌─────────────────────────────────┐
│  Page Hero                      │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  Cards Grid (3-6 карточек)      │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  CTA Section                    │
└─────────────────────────────────┘
```

### Pattern 3: Page Hero + Comparison + CTA

**Используется на:** Битрикс24 (сравнение облако/коробка)

```
┌─────────────────────────────────┐
│  Page Hero                      │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  Comparison Table               │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  CTA Section                    │
└─────────────────────────────────┘
```

### Pattern 4: Page Hero + Tariffs + CTA

**Используется на:** Тарифы Битрикс24, 1С-Битрикс

```
┌─────────────────────────────────┐
│  Page Hero                      │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  Tariff Cards (4-6 карточек)    │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  CTA Section                    │
└─────────────────────────────────┘
```

### Pattern 5: Form Page

**Используется на:** Обсудить проект

```
┌─────────────────────────────────┐
│  Page Hero                      │
└─────────────────────────────────┘
┌─────────────────────────────────┐
│  Form                           │
│  - Name                         │
│  - Company                      │
│  - Phone                        │
│  - Email                        │
│  - Task Description             │
│  - Dynamic Fields               │
│  - Consent                      │
└─────────────────────────────────┘
```

---

## 📝 Голос и тон

### Экспертный тон
- Конкретика вместо общих фраз
- Бизнес-сценарии вместо функций
- Реальные примеры вместо вымышленных

### Запрещённые фразы
- «50+ проектов»
- «40% рост»
- «80% обращаются повторно»
- «Лучшие в России»
- «Полный спектр услуг»

### Рекомендуемые фразы
- «Создаём связанные системы»
- «Проектируем до внедрения»
- «Учитываем ваши процессы»
- «Разделяем Битрикс24 и 1С-Битрикс»

---

## 📦 Зависимости

### Внешние

- **Google Fonts:** Inter (300, 400, 600, 700)
- **Нет фреймворков:** Чистый CSS/JS

### Внутренние

- `css/style.css` — 100% стилей
- `js/main.js` — 100% логики
- `partials/header.html` — шапка
- `partials/footer.html` — подвал

---

## 🚀 Оптимизации

### CSS
- Переиспользуемые компоненты
- БЭМ-подобная нотация
- Минимальное количество файлов (1 CSS)

### JS
- IIFE (Immediately Invoked Function Expression)
- Модульная структура
- Нет зависимостей

### Images
- SVG для логотипов
- Минимальное количество изображений
- Оптимизация для retina

---

## 📋 Чек-лист создания новой страницы

- [ ] Уникальный `<title>`
- [ ] Уникальный `<meta description>`
- [ ] Open Graph теги
- [ ] Canonical URL
- [ ] Хлебные крошки
- [ ] Page Hero с H1
- [ ] Секции с H2
- [ ] CTA-блок
- [ ] JSON-LD микроразметка
- [ ] Header и footer встроены
- [ ] Mobile menu работает
- [ ] Адаптивность проверена
- [ ] Ссылки на другие страницы
- [ ] Нет дубликатов элементов
