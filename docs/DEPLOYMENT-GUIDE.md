# Полная инструкция по развёртыванию Dianomi на Bitrix

## Оглавление

1. [Подготовка сайта](#1-подготовка-сайта)
2. [Загрузка компонентов](#2-загрузка-компонентов)
3. [Настройка шаблона сайта](#3-настройка-шаблона-сайта)
4. [Создание инфоблоков](#4-создание-инфоблоков)
5. [Создание элементов инфоблоков](#5-создание-элементов-инфоблоков)
6. [Создание страниц сайта](#6-создание-страниц-сайта)
7. [Загрузка ресурсов](#7-загрузка-ресурсов)
8. [Проверка и очистка кэша](#8-проверка-и-очистка-кэша)

---

## 1. Подготовка сайта

### 1.1 Структура директорий

Разместите файлы по следующим путям относительно корня сайта `s277847.h1n.ru`:

```
s277847.h1n.ru/
├── bitrix/
│   ├── header.php                    # prolog.php
│   ├── footer.php                    # epilog.php
│   ├── local/
│   │   └── components/
│   │       └── dianomi/              # 8 компонентов (см. п.2)
│   └── templates/
│       └── dianomi/                  # шаблон сайта (см. п.3)
├── dianomi/                          # дубликат для отдельного сайта
│   ├── index.php
│   ├── about.php
│   ├── contacts.php
│   ├── business-systems.php
│   ├── bitrix24.php
│   ├── bitrix24-prices.php
│   ├── web-systems.php
│   ├── 1c-bitrix.php
│   ├── 1c-bitrix-prices.php
│   ├── data-bi.php
│   ├── project.php
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── img/
│       ├── logo-dianomi.svg
│       ├── logo-bitrix.svg
│       └── ...
├── index.php                         # главная
└── upload/                           # папка для загрузок
```

### 1.2 Настройка сайта в админке

1. **Админка → Настройки → Настройки продукта → Сайты**
2. Убедитесь что сайт с кодом `s277847.h1n.ru` активен
3. **Админка → Настройки → Настройки продукта → Шаблоны сайтов**
4. Найдите шаблон `dianomi` и привяжите его к сайту `s277847.h1n.ru`

---

## 2. Загрузка компонентов

### 2.1 Структура компонентов

Каждый компонент находится в папке:
```
bitrix/local/components/dianomi/{имя_компонента}/
├── .description.php      # описание компонента
├── .parameters.php       # параметры компонента
├── class.php             # PHP-класс компонента
├── lang/
│   └── ru/
│       ├── .description.php    # локализованное описание
│       └── .parameters.php     # локализованные параметры
└── templates/
    └── .default/
        ├── template.php        # шаблон вывода
        └── template.style.css  # стили компонента
```

### 2.2 8 компонентов Dianomi

| # | Код компонента | Название | Инфоблок |
|---|---------------|----------|----------|
| 1 | `hero` | Hero Section | `page_hero` |
| 2 | `problems` | Проблемы | `page_problems` |
| 3 | `solutions` | Решения | `page_solutions` |
| 4 | `faq` | FAQ | `page_faq` |
| 5 | `before-after` | До/После | `page_before_after` |
| 6 | `approach` | Наш подход | `page_approach` |
| 7 | `about-company` | О компании | `page_about` |
| 8 | `cta-form` | CTA с формой | (нет инфоблока) |

### 2.3 Параметры компонента `hero`

| Параметр | Тип | По умолчанию | Описание |
|----------|-----|-------------|----------|
| `PAGE_CODE` | STRING | `index` | Код страницы (index, about, contacts, business-systems, bitrix24, web-systems, 1c-bitrix, data-bi) |

### 2.4 Параметры всех остальных компонентов

Все остальные 7 компонентов **не имеют пользовательских параметров**.

### 2.5 Подключение компонентов на страницу

На каждой странице (index.php, about.php и т.д.) компоненты подключаются в следующем порядке:

```php
<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Dianomi — Битрикс24, 1С-Битрикс, интеграции");
$APPLICATION->SetPageProperty("description", "Внедряем облачный и коробочный Битрикс24, создаём веб-системы на 1С-Битрикс, интегрируем их с 1С.");
// ... og теги ...
?>

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "index",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:problems", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:solutions", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:before-after", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:approach", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:about-company", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:faq", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
```

---

## 3. Настройка шаблона сайта

### 3.1 Структура шаблона

```
bitrix/templates/dianomi/
├── header.php        # шапка сайта
├── footer.php        # подвал сайта
├── template.php      # основной контент
├── css/
│   └── style.css     # все стили
├── js/
│   └── main.js       # JavaScript
└── img/
    ├── logo-dianomi.svg
    └── ...
```

### 3.2 Подключение шаблона

**Админка → Настройки → Настройки продукта → Шаблоны сайтов**

Выберите сайт `s277847.h1n.ru` и укажите шаблон `dianomi`.

### 3.3 Структура header.php

```
DOCTYPE html → lang="ru" → meta tags → Google Fonts (Inter) → CSS (SITE_TEMPLATE_PATH . '/css/style.css')
```

**Меню навигации:**
- Главная → `/`
- Решения → `/business-systems.php` (mega-menu с 7 подпунктами)
  - Системы управления бизнесом
  - Битрикс24
  - Тарифы Битрикс24
  - Веб-системы
  - 1С-Битрикс
  - Тарифы 1С-Битрикс
  - Данные и BI-аналитика
- О компании → `/about.php`
- Контакты → `/contacts.php`

**Кнопка CTA:** "Обсудить проект" → `/contacts.php`

### 3.4 Структура footer.php

```
.footer
├── .footer__brand (logo + описание + контакты)
│   ├── +7 (3852) 000-00-00
│   ├── info@dianomi.ru
│   └── г. Барнаул
├── Решения (7 ссылок)
├── Dianomi (О компании, Контакты)
└── © 2026 dianomi
```

---

## 4. Создание инфоблоков

### 4.1 Тип инфоблока

**Админка → Контент → Инфоблоки → Типы инфоблоков → Добавить**

| Поле | Значение |
|------|----------|
| **Тип инфоблока (код)** | `information_pages` |
| **Название** | Страницы сайта |

### 4.2 Инфоблоки и их свойства

#### 4.2.1 Инфоблок `page_hero` — "Hero Section"

**Админка → Контент → Инфоблоки → Добавить инфоблок**

| Поле | Значение |
|------|----------|
| **Тип (код)** | `information_pages` |
| **Код** | `page_hero` |
| **Название** | Hero Section |

**Свойства:**

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `BADGE_TEXT` | Текст бейджа | Строка (S) | Нет |
| `TITLE` | Заголовок | Строка (S) | Нет |
| `DESCRIPTION` | Описание | Строка (S) | Нет |
| `COUNTER_1` | Счётчик 1 | Строка (S) | Нет |
| `COUNTER_2` | Счётчик 2 | Строка (S) | Нет |
| `COUNTER_3` | Счётчик 3 | Строка (S) | Нет |
| `COUNTER_LABEL_1` | Подпись счётчика 1 | Строка (S) | Нет |
| `COUNTER_LABEL_2` | Подпись счётчика 2 | Строка (S) | Нет |
| `COUNTER_LABEL_3` | Подпись счётчика 3 | Строка (S) | Нет |
| `BENEFITS_LIST` | Преимущества | Строка (S) | **Да** |

#### 4.2.2 Инфоблок `page_problems` — "Problems"

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `ICON` | Иконка | Строка (S) | Нет |
| `TITLE` | Заголовок | Строка (S) | Нет |
| `DESCRIPTION` | Описание | Строка (S) | Нет |
| `ORDER` | Порядок | Строка (S) | Нет |

#### 4.2.3 Инфоблок `page_solutions` — "Solutions"

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `ICON` | Иконка | Строка (S) | Нет |
| `TITLE` | Заголовок | Строка (S) | Нет |
| `DESCRIPTION` | Описание | Строка (S) | Нет |
| `BENEFITS` | Преимущества | Строка (S) | **Да** |
| `LINK_TEXT` | Текст ссылки | Строка (S) | Нет |
| `LINK_URL` | URL ссылки | Строка (S) | Нет |
| `BORDER_COLOR` | Цвет рамки | Строка (S) | Нет |
| `ORDER` | Порядок | Строка (S) | Нет |

#### 4.2.4 Инфоблок `page_before_after` — "Before/After"

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `BEFORE_TITLE` | Заголовок до | Строка (S) | Нет |
| `AFTER_TITLE` | Заголовок после | Строка (S) | Нет |
| `BEFORE_TEXT` | Текст до | Строка (S) | Нет |
| `AFTER_TEXT` | Текст после | Строка (S) | Нет |

#### 4.2.5 Инфоблок `page_approach` — "Approach"

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `ICON` | Иконка | Строка (S) | Нет |
| `TITLE` | Заголовок | Строка (S) | Нет |
| `DESCRIPTION` | Описание | Строка (S) | Нет |
| `ORDER` | Порядок | Строка (S) | Нет |

#### 4.2.6 Инфоблок `page_about` — "About Company"

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `DESCRIPTION` | Описание | Строка (S) | Нет |
| `OFFICE` | Офис | Строка (S) | Нет |
| `FEATURES` | Преимущества | Строка (S) | Нет |

> ⚠️ **Важно:** В `install-iblocks.php` инфоблок называется `page_about_company`, но компонент `about-company` ожидает `page_about`. Создавайте с кодом `page_about`.

#### 4.2.7 Инфоблок `page_faq` — "FAQ"

| Код свойства | Название | Тип | Множественное |
|-------------|----------|-----|--------------|
| `QUESTION` | Вопрос | Строка (S) | Нет |
| `ANSWER` | Ответ | Строка (S) | Нет |
| `ORDER` | Порядок | Строка (S) | Нет |

---

## 5. Создание элементов инфоблоков

### 5.1 Элемент инфоблока `page_hero`

**Админка → Контент → Инфоблоки → page_hero → Элементы → Добавить элемент**

| Поле | Значение |
|------|----------|
| **Код элемента (URL)** | `index` |
| **Свойство BADGE_TEXT** | Текст бейджа (например: "Битрикс24") |
| **Свойство TITLE** | Главный заголовок |
| **Свойство DESCRIPTION** | Описание |
| **Свойство COUNTER_1** | Число (например: "500+") |
| **Свойство COUNTER_2** | Число (например: "100+") |
| **Свойство COUNTER_3** | Число (например: "50+") |
| **Свойство COUNTER_LABEL_1** | Подпись (например: "Проектов") |
| **Свойство COUNTER_LABEL_2** | Подпись (например: "Клиентов") |
| **Свойство COUNTER_LABEL_3** | Подпись (например: "Лет опыта") |
| **Свойство BENEFITS_LIST** | Множественное — список преимуществ |

> Для других страниц создайте элементы с кодами: `about`, `contacts`, `business-systems` и т.д.

### 5.2 Элементы инфоблока `page_problems`

**Админка → Контент → Инфоблоки → page_problems → Элементы → Добавить элемент** (создать несколько)

| Поле | Значение |
|------|----------|
| **Свойство ICON** | Иконка (код иконки или URL) |
| **Свойство TITLE** | Заголовок проблемы |
| **Свойство DESCRIPTION** | Описание проблемы |
| **Свойство ORDER** | Порядок (например: "10", "20", "30") |

> Типичные проблемы: "Тратите время на рутину", "Не знаете что делать", "Команда не справляется"

### 5.3 Элементы инфоблока `page_solutions`

**Админка → Контент → Инфоблоки → page_solutions → Элементы → Добавить элемент** (создать несколько)

| Поле | Значение |
|------|----------|
| **Свойство ICON** | Иконка |
| **Свойство TITLE** | Заголовок решения |
| **Свойство DESCRIPTION** | Описание |
| **Свойство BENEFITS** | Множественное — список преимуществ |
| **Свойство LINK_TEXT** | Текст ссылки (например: "Подробнее") |
| **Свойство LINK_URL** | URL ссылки (например: "/bitrix24.php") |
| **Свойство BORDER_COLOR** | Цвет рамки (например: "#2A5B9A") |
| **Свойство ORDER** | Порядок |

> Типичные решения: "Внедрение Битрикс24", "1С-Битрикс", "Интеграции"

### 5.4 Элемент инфоблока `page_before_after`

**Админка → Контент → Инфоблоки → page_before_after → Элементы → Добавить элемент**

| Поле | Значение |
|------|----------|
| **Свойство BEFORE_TITLE** | Заголовок "До" (например: "Без Dianomi") |
| **Свойство AFTER_TITLE** | Заголовок "После" (например: "С Dianomi") |
| **Свойство BEFORE_TEXT** | Текст до (список минусов через \n) |
| **Свойство AFTER_TEXT** | Текст после (список плюсов через \n) |

### 5.5 Элементы инфоблока `page_approach`

**Админка → Контент → Инфоблоки → page_approach → Элементы → Добавить элемент** (создать несколько)

| Поле | Значение |
|------|----------|
| **Свойство STEP_NUMBER** | Номер шага (например: "1", "2", "3", "4") |
| **Свойство TITLE** | Заголовок шага |
| **Свойство ORDER** | Порядок |

> Типичные шаги: "Анализ", "Проектирование", "Внедрение", "Поддержка"

### 5.6 Элемент инфоблока `page_about`

**Админка → Контент → Инфоблоки → page_about → Элементы → Добавить элемент**

| Поле | Значение |
|------|----------|
| **Свойство DESCRIPTION** | Описание компании |
| **Свойство OFFICE** | Информация об офисе |
| **Свойство FEATURES** | Преимущества (через \n) |

### 5.7 Элементы инфоблока `page_faq`

**Админка → Контент → Инфоблоки → page_faq → Элементы → Добавить элемент** (создать несколько)

| Поле | Значение |
|------|----------|
| **Свойство QUESTION** | Вопрос |
| **Свойство ANSWER** | Ответ |
| **Свойство ORDER** | Порядок |

> Типичные вопросы: "Сколько стоит внедрение?", "Какие сроки?", "Есть ли поддержка?"

---

## 6. Создание страниц сайта

### 6.1 Главная страница (`index.php`)

**Путь:** Корень сайта `/index.php`

```php
<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Dianomi — Битрикс24, 1С-Битрикс, интеграции");
$APPLICATION->SetPageProperty("description", "Внедряем облачный и коробочный Битрикс24, создаём веб-системы на 1С-Битрикс, интегрируем их с 1С.");
?>

<?$APPLICATION->IncludeComponent("dianomi:hero", ".default", array(
    "PAGE_CODE" => "index",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:problems", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:solutions", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:before-after", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:approach", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:about-company", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:faq", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
```

### 6.2 Страницы сайта

Создайте файлы в корне сайта:

| Файл | Страница |
|------|----------|
| `about.php` | О компании |
| `contacts.php` | Контакты |
| `business-systems.php` | Системы управления бизнесом |
| `bitrix24.php` | Битрикс24 |
| `bitrix24-prices.php` | Тарифы Битрикс24 |
| `web-systems.php` | Веб-системы |
| `1c-bitrix.php` | 1С-Битрикс |
| `1c-bitrix-prices.php` | Тарифы 1С-Битрикс |
| `data-bi.php` | Данные и BI-аналитика |
| `project.php` | Форма проекта |
| `404.php` | Страница 404 |

Каждая страница содержит:
```php
<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Название страницы");
// ... og теги ...
?>

<?=$APPLICATION->ShowContent()?>

<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
```

---

## 7. Загрузка ресурсов

### 7.1 CSS

**Путь:** `bitrix/templates/dianomi/css/style.css`

Содержит все стили сайта, включая CSS-переменные:
- `--bg: #F8F9FA`
- `--primary: #2A5B9A`
- `--accent: #D4600A`
- `--text: #2D3142`
- и т.д.

### 7.2 JavaScript

**Путь:** `bitrix/templates/dianomi/js/main.js`

Функции:
- `openMenu()` / `closeMenu()` — мобильное меню
- `initMobileMenu()` — инициализация бургера
- `initDropdown()` — мобильные dropdown
- `initMegaMenu()` — десктопное mega-menu
- `onScrollHeader()` — скролл-эффект шапки
- FAQ Accordion — аккордеон вопросов
- Phone Mask — маска телефона `+7 (XXX) XXX-XX-XX`
- Scroll animations — IntersectionObserver
- Cookie Notice — согласие на cookies
- Form Handler — обработка форм

### 7.3 Изображения

**Путь:** `bitrix/templates/dianomi/img/`

| Файл | Описание |
|------|----------|
| `logo-dianomi.svg` | Логотип Dianomi |
| `logo-bitrix.svg` | Логотип Битрикс |
| `logo-partner-badge.svg` | Бейдж партнёра |
| `og-default.jpg` | OG-изображение |
| `og-business-systems.jpg` | OG для business-systems |
| `og-web-systems.jpg` | OG для web-systems |

### 7.4 Шрифты

Google Fonts: **Inter** (300, 400, 600, 700)

---

## 8. Проверка и очистка кэша

### 8.1 Очистка кэша

**Админка → Настройки → Настройки продукта → Кэш → Очистить кэш**

Или через CLI:
```bash
php /dev.php --clear-cache=all
```

### 8.2 Проверка компонентов

**Админка → Контент → Компоненты → Справочник компонентов**

Убедитесь что все 8 компонентов отображаются в ��атегории "Dianomi":

| Компонент | Код | Название |
|-----------|-----|----------|
| `dianomi:hero` | .default | Hero Section |
| `dianomi:problems` | .default | Проблемы |
| `dianomi:solutions` | .default | Решения |
| `dianomi:before-after` | .default | До/После |
| `dianomi:approach` | .default | Наш подход |
| `dianomi:about-company` | .default | О компании |
| `dianomi:faq` | .default | FAQ |
| `dianomi:cta-form` | .default | CTA с формой |

### 8.3 Проверка шаблона

**Админка → Настройки → Настройки продукта → Шаблоны сайтов**

Убедитесь что:
- Шаблон `dianomi` активен
- Привязан к сайту `s277847.h1n.ru`
- Содержит header.php, footer.php, template.php

### 8.4 Чек-лист проверки

- [ ] Страница загружается без ошибок PHP
- [ ] Шапка с меню отображается
- [ ] Подвал с контактами отображается
- [ ] Hero-секция показывает данные из инфоблока `page_hero`
- [ ] Проблемы отображаются из `page_problems`
- [ ] Решения отображаются из `page_solutions`
- [ ] Блок До/После отображается из `page_before_after`
- [ ] Наш подход отображается из `page_approach`
- [ ] О компании отображается из `page_about`
- [ ] FAQ-аккордеон работает из `page_faq`
- [ ] CTA-форма отображается
- [ ] Мобильное меню работает
- [ ] Phone Mask работает
- [ ] FAQ Accordion работает
- [ ] Scroll-анимации работают
