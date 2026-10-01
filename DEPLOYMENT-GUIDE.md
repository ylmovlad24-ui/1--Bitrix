# Инструкция по развёртыванию сайта Dianomi на 1С-Битрикс (HostiMan, Business)

## 📦 Структура архива `dianomi-site.zip`

```
dianomi-site.zip
├── index.php                    ← Главная (hero + problems + solutions + before-after + approach + about + faq + cta-form)
├── about.php                    ← О компании (hero + about-company + cta-form)
├── contacts.php                 ← Контакты (hero + cta-form)
├── business-systems.php         ← Системы управления бизнесом (hero + solutions + before-after + cta-form)
├── bitrix24.php                 ← Битрикс24 (hero + solutions + before-after + cta-form)
├── bitrix24-prices.php          ← Тарифы Битрикс24 (hero + cta-form)
├── 1c-bitrix.php                ← 1С-Битрикс (hero + solutions + before-after + cta-form)
├── 1c-bitrix-prices.php         ← Тарифы 1С-Битрикс (hero + cta-form)
├── web-systems.php              ← Веб-системы (hero + solutions + before-after + cta-form)
├── data-bi.php                  ← Данные и BI-аналитика (hero + cta-form)
├── project.php                  ← Форма заявки (hero + bitrix:form)
├── 404.php                      ← Страница 404 (статический контент)
├── success.php                  ← Успешная отправка (статический контент)
├── .top.menu.php                ← Файл меню (массив $aMenuLinks)
├── .htaccess                    ← Настройки сервера
├── robots.txt                   ← Индексация
├── sitemap.xml                  ← Карта сайта
│
├── /bitrix/templates/dianomi/   ← Шаблон сайта
│   ├── .description.php         ← Описание шаблона для Bitrix
│   ├── .style.php               ← Настройки шаблона
│   ├── header.php               ← Шапка (DOCTYPE, head, меню bitrix:menu)
│   ├── footer.php               ← Подвал (footer, </body></html>)
│   ├── template.php             ← Обёртка контента (<main id="main-content">)
│   ├── css/
│   │   └── style.css            ← Дизайн-система (~1100 строк)
│   ├── js/
│   │   └── main.js              ← Вся логика (~300 строк)
│   ├── img/                     ← Изображения шаблона
│   │   ├── logo-dianomi.svg
│   │   ├── logo-bitrix.svg
│   │   ├── logo-partner-badge.svg
│   │   ├── og-default.jpg
│   │   ├── og-business-systems.jpg
│   │   └── og-web-systems.jpg
│   │
│   └── /components/dianomi/     ← Шаблоны компонентов (ПРАВИЛЬНОЕ расположение!)
│       ├── hero/templates/.default/
│       │   ├── template.php     ← HTML-представление hero
│       │   └── style.css
│       ├── problems/templates/.default/
│       │   ├── template.php
│       │   └── style.css
│       ├── solutions/templates/.default/
│       │   ├── template.php
│       │   └── style.css
│       ├── before-after/templates/.default/
│       │   ├── template.php
│       │   └── style.css
│       ├── approach/templates/.default/
│       │   ├── template.php
│       │   └── style.css
│       ├── about-company/templates/.default/
│       │   ├── template.php
│       │   └── style.css
│       ├── faq/templates/.default/
│       │   ├── template.php
│       │   └── style.css
│       └── cta-form/templates/.default/
│           ├── template.php
│           └── style.css
│
└── /bitrix/local/components/    ← Бизнес-логика компонентов
    ├── dianomi/                 ← 8 кастомных компонентов
    │   ├── hero/
    │   │   ├── class.php        ← Бизнес-логика (D7 ORM)
    │   │   ├── .description.php ← Описание компонента
    │   │   ├── .parameters.php  ← Параметры
    │   │   └── lang/ru/.parameters.php
    │   ├── problems/
    │   │   ├── class.php
    │   │   ├── .description.php
    │   │   └── ...
    │   ├── solutions/
    │   │   ├── class.php
    │   │   ├── .description.php
    │   │   └── ...
    │   ├── before-after/
    │   │   ├── class.php
    │   │   ├── .description.php
    │   │   └── ...
    │   ├── approach/
    │   │   ├── class.php
    │   │   ├── .description.php
    │   │   └── ...
    │   ├── about-company/
    │   │   ├── class.php
    │   │   ├── .description.php
    │   │   └── ...
    │   ├── faq/
    │   │   ├── class.php
    │   │   ├── .description.php
    │   │   └── ...
    │   └── cta-form/
    │       ├── class.php
    │       ├── .description.php
    │       └── ...
    │
    └── bitrix/                  ← Кастомные шаблоны для системных компонентов
        ├── menu/templates/megamenu/
        │   ├── template.php     ← Рендер мегамENU
        │   └── style.css
        └── form/templates/project_form/
            └── template.php     ← Форма заявки
```

---

## ШАГ 1: Установка 1С-Битрикс на HostiMan

### 1.1 Создание базы данных

1. Зайдите на HostiMan → управляемый хостинг
2. Перейдите в раздел **"Базы данных"**
3. Нажмите **"Создать базу данных"**
4. Выберите тип: **MySQL**
5. Запомните данные:
   - **Имя БД:** (например, `dianomi`)
   - **Логин:** (например, `seodianomi`)
   - **Пароль:** (например, `!SeoDianomi94`)

### 1.2 Установка Bitrix

1. Перейдите в раздел **"Установка"**
2. Выберите **1С-Битрикс: Бизнес**
3. Заполните данные:
   - **Домен:** `dianomi.ru`
   - **Папка сайта:** `/` (пустая — корень)
   - **База данных:** выберите созданную ранее
   - **Администратор:** логин `admin`, пароль (запомните!)
4. Дождитесь окончания установки

---

## ШАГ 2: Загрузка файлов

### 2.1 Загрузка архива

Архив: `dianomi-site.zip`

1. Зайдите в файловый менеджер HostiMan
2. Перейдите в корень сайта (обычно `/` или `/www/`)
3. Загрузите `dianomi-site.zip`
4. Нажмите на файл → **"Извлечь"**
5. Дождитесь окончания извлечения

### 2.2 Создание папки upload

Через файловый менеджер создайте пустую папку:
```
/bitrix/uploads/
```

### 2.3 Настройка прав

| Папка | Права |
|-------|-------|
| `/bitrix/templates/` | 755 |
| `/bitrix/local/` | 755 |
| `/bitrix/uploads/` | 777 |

---

## ШАГ 3: Вход в админку

```
URL: https://dianomi.ru/bitrix/
Логин: admin
Пароль: (который задали при установке)
```

---

## ШАГ 4: Создание сайта (мульти-сайт)

### 4.1 Создание сайта

**Путь:** `Настройки → Настройки продукта → Структура сайта → Список сайтов`

1. Нажмите **"Создать сайт"**
2. Заполните:

| Поле | Значение |
|------|----------|
| **Domain** | `dianomi.ru` |
| **Site name** | `Dianomi` |
| **Site directory** | (пустое — корень) |
| **Default theme** | `dianomi` |
| **Sort** | `100` |
| **Active** | `Да` |
| **Language** | `ru` |

3. Нажмите **"Сохранить"**

### 4.2 Привязка шаблона

**Путь:** `Настройки → Настройки продукта → Сайты → Шаблоны сайтов`

1. Найдите шаблон **"dianomi"**
2. Нажмите **"Привязать"** рядом с сайтом `dianomi.ru`
3. Нажмите **"Сохранить"**

---

## ШАГ 5: Создание меню

### 5.1 Файл меню

Файл `.top.menu.php` уже загружен в корень сайта. Содержит массив `$aMenuLinks`:

```php
$aMenuLinks = [
    ["Главная", "/", [], [], ""],
    ["Решения", "/business-systems.php", [], [], "/business-systems.php|/bitrix24.php|..."],
    ["О компании", "/about.php", [], [], ""],
    ["Контакты", "/contacts.php", [], [], ""]
];
```

### 5.2 Создание пункта меню в админке (для корректной работы)

**Путь:** `Настройки → Настройки продукта → Структура сайта → Меню → Главное меню`

Создайте пункты меню:

| Текст | Ссылка | Порядок |
|-------|--------|---------|
| Главная | `/` | 100 |
| Решения | `/business-systems.php` | 200 |
| ↳ Системы управления бизнесом | `/business-systems.php` | 201 |
| ↳ Битрикс24 | `/bitrix24.php` | 202 |
| ↳ Тарифы Битрикс24 | `/bitrix24-prices.php` | 203 |
| ↳ Веб-системы | `/web-systems.php` | 204 |
| ↳ 1С-Битрикс | `/1c-bitrix.php` | 205 |
| ↳ Тарифы 1С-Битрикс | `/1c-bitrix-prices.php` | 206 |
| ↳ Данные и BI-аналитика | `/data-bi.php` | 207 |
| О компании | `/about.php` | 300 |
| Контакты | `/contacts.php` | 400 |

---

## ШАГ 6: Создание IBlock и элементов

### 6.1 Создание типа инфоблоков

**Путь:** `Контент → Инфоблоки → Типы инфоблоков → Создать тип`

1. **Тип:** `content`
2. Нажмите **"Сохранить"**

### 6.2 Создание инфоблоков

**Путь:** `Контент → Инфоблоки → Создать инфоблок`

Создайте 7 инфоблоков:

| Код | Название | Тип |
|-----|----------|-----|
| `page_hero` | Hero-блоки | S (свойства) |
| `page_problems` | Проблемы | S |
| `page_solutions` | Решения | S |
| `page_before_after` | До/После | S |
| `page_approach` | Подход | S |
| `page_about` | О компании | S |
| `page_faq` | FAQ | S |

### 6.3 Создание свойств

Для каждого инфоблока создайте свойства:

**page_hero:**
- `BADGE_TEXT` — Текст бейджа (STRING)
- `TITLE` — H1 заголовок (STRING)
- `DESCRIPTION` — Описание (STRING)
- `COUNTER_1` — Счётчик 1 (INTEGER)
- `COUNTER_2` — Счётчик 2 (INTEGER)
- `COUNTER_3` — Счётчик 3 (STRING)
- `COUNTER_LABEL_1` — Подпись счётчика 1 (STRING)
- `COUNTER_LABEL_2` — Подпись счётчика 2 (STRING)
- `COUNTER_LABEL_3` — Подпись счётчика 3 (STRING)
- `BENEFITS_LIST` — Список преимуществ (TEXT)

**page_problems:**
- `ICON` — Иконка (STRING)
- `TITLE` — Заголовок (STRING)
- `DESCRIPTION` — Описание (TEXT)
- `ORDER` — Порядок (INTEGER)

**page_solutions:**
- `ICON` — Иконка (STRING)
- `TITLE` — Заголовок (STRING)
- `DESCRIPTION` — Описание (TEXT)
- `BENEFITS` — Список преимуществ (TEXT)
- `LINK_TEXT` — Текст ссылки (STRING)
- `LINK_URL` — URL ссылки (STRING)
- `ORDER` — Порядок (INTEGER)
- `BORDER_COLOR` — Цвет рамки (STRING)

**page_before_after:**
- `BEFORE_TITLE` — Заголовок До (STRING)
- `AFTER_TITLE` — Заголовок После (STRING)
- `BEFORE_LIST` — Список До (TEXT)
- `AFTER_LIST` — Список После (TEXT)

**page_approach:**
- `STEP_NUMBER` — Номер шага (STRING)
- `TITLE` — Название шага (STRING)
- `ORDER` — Порядок (INTEGER)

**page_about:**
- `DESCRIPTION` — Описание (TEXT)
- `OFFICE` — Офис (STRING)
- `FEATURES` — Преимущества (TEXT)

**page_faq:**
- `QUESTION` — Вопрос (STRING)
- `ANSWER` — Ответ (TEXT)
- `ORDER` — Порядок (INTEGER)

### 6.4 Создание элементов

Для каждого инфоблока создайте элементы с заполненными свойствами.

---

## ШАГ 7: Настройка веб-формы

### 7.1 Создание веб-формы

**Путь:** `Контент → Веб-формы → Создать веб-форму`

1. **Название:** `Заявка на проект`
2. **Код:** `project_form`
3. Создайте поля:
   - Имя (обязательное)
   - Телефон (обязательное)
   - Email
   - Сообщение

### 7.2 Настройка защиты

1. **Использовать CAPTCHA:** Да
2. **Проверка обязательных полей:** Да
3. **Проверка по регулярным выражениям:** Да (для телефона)

---

## ШАГ 8: Проверка

Откройте в браузере:
```
https://dianomi.ru/
```

### Чек-лист проверки:

- [ ] Шапка отображается (логотип + меню)
- [ ] Мобильное меню открывается/закрывается
- [ ] МегамENU работает на десктопе
- [ ] CSS загружается (стили применены)
- [ ] JS работает (анимации, маска телефона)
- [ ] Все ссылки работают
- [ ] Footer отображается корректно
- [ ] SEO-метаданные уникальны

---

## 📋 Быстрый чек-лист (если не работает)

| Проблема | Решение |
|----------|---------|
| Шаблон "dianomi" не появляется | Проверьте наличие `.description.php` |
| CSS не грузится | Проверьте путь: `/bitrix/templates/dianomi/css/style.css` |
| Двойная шапка | Уберите `require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php")` из header.php |
| Пустая страница | Проверьте наличие `template.php` |
| Компоненты не найдены | Проверьте: `/bitrix/local/components/dianomi/` |
| 404 на страницах | Проверьте: сайт привязан к правильному домену |
| Меню не отображается | Проверьте: главное меню настроено в админке |

---

## 🎯 Многосайтовость (Business)

### Создание второго сайта

1. **Путь:** `Настройки → Настройки продукта → Структура сайта → Список сайтов`
2. Нажмите **"Создать сайт"**
3. Заполните:

| Поле | Значение |
|------|----------|
| **Domain** | `site2.ru` |
| **Site name** | `Site 2` |
| **Site directory** | `site2/` |
| **Default theme** | (выберите шаблон) |
| **Sort** | `200` |
| **Active** | `Да` |
| **Language** | `ru` |

4. Нажмите **"Сохранить"**

**Важно:** Все сайты используют ОДНУ файловую структуру Bitrix. Не нужно копировать `/bitrix` на разные домены!

---

## 📞 Контакты поддержки

- **Документация Bitrix:** https://dev.1c-bitrix.ru
- **Форум:** https://forum.bitrix.ru
- **Поддержка HostiMan:** https://hostiman.ru/support

---

## ✅ Готово!

Сайт Dianomi развёрнут на 1С-Битрикс (Business) с поддержкой многосайтовости.
