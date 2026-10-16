# Инструкция по развёртыванию сайта Dianomi на 1C-Bitrix (Hostiman)

## Шаг 1: Установка Bitrix

1. Зайди на хостиман → управляемый хостинг → dianomi.ru
2. В разделе **"Установка"** → выбери **"1C-Bitrix: Business"**
3. Заполни данные БД:
   - Хост: `localhost`
   - База данных: `dianomi`
   - Логин: `seodianomi`
   - Пароль: `!SeoDianomi94`
4. Дождись установки

## Шаг 2: Создай сайт в подпапке

Админка → **Настройки → Настройки продукта → Структура сайта** → **Список сайтов** → редактируй сайт s1:

| Поле | Значение |
|------|----------|
| **Доменное имя** | `s277847.h1n.ru/dianomi` |
| **Папка сайта** | `/dianomi/` |
| **Путь к корневой папке** | нажми **"вставить текущий"** |

Нажми **"Сохранить"**.

## Шаг 3: Создай архив и загрузи на сервер

### Локально (на компьютере):

1. Открой папку `C:\Users\Анна\IdeaProjects\bitrix\dianomi\`
2. Выдели **ВСЁ** содержимое (Ctrl+A)
3. ПКМ → **Отправить** → **Сжатая ZIP-папка**
4. Назови архив `dianomi-site.zip`
5. Загрузи этот ZIP в папку `/dianomi/` на хостмани

### На хостмани:

1. Зайди в файловый менеджер → папка `/dianomi/`
2. Нажми **"Загрузить файлы"** → выбери `dianomi-site.zip`
3. Выбери `dianomi-site.zip` → нажми **"Извлечь"**
4. Дождись окончания извлечения

## Шаг 4: Создай пустую папку upload

Через файловый менеджер в `/dianomi/` создай пустую папку:
```
upload/
```

## Шаг 5: Привяжи шаблон к сайту

Админка → **Настройки → Настройки продукта → Сайты** → **Шаблоны сайтов**:
1. Найди шаблон **"dianomi"**
2. Нажми **"Привязать"** для сайта `s277847.h1n.ru/dianomi`
3. Нажми **"Сохранить"**

## Шаг 6: Создай меню

Админка → **Настройки → Настройки продукта → Структура сайта** → **Меню** → **Главное меню**:

Добавь пункты:
- Главная → `/`
- Решения → `/business-systems.php` (с подразделами):
  - Системы управления бизнесом → `/business-systems.php`
  - Битрикс24 → `/bitrix24.php`
  - Тарифы Битрикс24 → `/bitrix24-prices.php`
  - Веб-системы → `/web-systems.php`
  - 1С-Битрикс → `/1c-bitrix.php`
  - Тарифы 1С-Битрикс → `/1c-bitrix-prices.php`
  - Данные и BI-аналитика → `/data-bi.php`
- О компании → `/about.php`
- Контакты → `/contacts.php`

## Шаг 7: Создай IBlock и элементы

Админка → **Контент → Контент** → создай IBlock типа "content" (если ещё не создан) с ID 1-7:

| ID | Название |
|----|----------|
| 1 | Hero |
| 2 | Проблемы |
| 3 | Решения |
| 4 | До/После |
| 5 | Подход |
| 6 | О компании |
| 7 | FAQ |

В каждый IBlock добавь хотя бы 1 элемент с заполненными свойствами.

## Шаг 8: Проверь

Открой в браузере:
```
https://s277847.h1n.ru/dianomi/
```

---

## Структура файлов в архиве

```
dianomi/
├── index.php                    ← Главная
├── about.php                    ← О компании
├── contacts.php                 ← Контакты
├── project.php                  ← Проекты
├── business-systems.php         ← Системы управления бизнесом
├── bitrix24.php                 ← Битрикс24
├── bitrix24-prices.php          ← Тарифы Битрикс24
├── 1c-bitrix.php                ← 1С-Битрикс
├── 1c-bitrix-prices.php         ← Тарифы 1С-Битрикс
├── data-bi.php                  ← Данные и BI-аналитика
├── web-systems.php              ← Веб-системы
├── 404.php                      ← Страница 404
├── .htaccess
├── robots.txt
├── sitemap.xml
├── header.php                   ← Шапка шаблона
├── footer.php                   ← Подвал шаблона
├── css/style.css
├── js/main.js
├── img/                         ← Логотипы и OG-картинки
├── partials/                    ← HTML-шаблоны (не используются в Bitrix)
│
├── bitrix/
│   ├── templates/
│   │   └── dianomi/             ← Шаблон сайта
│   │       ├── .description.php
│   │       ├── .style.php
│   │       ├── header.php       ← Шапка (DOCTYPE, head, меню)
│   │       ├── footer.php       ← Подвал (footer, </body></html>)
│   │       ├── template.php     ← Обёртка: <main id="main-content">
│   │       ├── css/style.css
│   │       ├── js/main.js
│   │       ├── img/logo-dianomi.svg
│   │       ├── lang/ru/footer.php
│   │       ├── lang/ru/header.php
│   │       └── components/bitrix/menu/templates/megamenu/
│   │           ├── result.mod.php
│   │           ├── style.css
│   │           └── template.php
│   │
│   └── local/
│       ├── components/
│       │   ├── dianomi/         ← 8 кастомных компонентов
│       │   │   ├── hero/
│       │   │   ├── problems/
│       │   │   ├── solutions/
│       │   │   ├── before-after/
│       │   │   ├── approach/
│       │   │   ├── about-company/
│       │   │   ├── faq/
│       │   │   └── cta-form/
│       │   │
│       │   └── bitrix/
│       │       └── menu/templates/megamenu/
│       │           ├── result.mod.php
│       │           ├── style.css
│       │           └── template.php
│       │
│       ├── modules/dianomi/     ← Модуль
│       └── php/
│           ├── install_full_site.php
│           └── install_iblocks.php
```

---

## Ключевые особенности реализации

### ✅ Компоненты в правильной папке
Все компоненты лежат в `/dianomi/bitrix/local/components/` — Bitrix ищет их только там.

### ✅ Пути к ресурсам от корня сайта
В `header.php` и `footer.php` используются пути:
- `/bitrix/templates/dianomi/css/style.css`
- `/bitrix/templates/dianomi/js/main.js`
- `/bitrix/templates/dianomi/img/logo-dianomi.svg`

Bitrix автоматически определяет корень сайта, поэтому `/dianomi/` в начале не нужен.

### ✅ Header.php БЕЗ require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php")
Header.php шаблона НЕ должен содержать `require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php")` — это вызывает дублирование шапки Bitrix.

### ✅ Footer.php закрывает HTML
Footer.php шаблона содержит `</body></html>` и НЕ подключает `require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")`.

### ✅ Меню статическое в header.php
Меню реализовано через компонент `bitrix:menu` с шаблоном `megamenu`, который подключается в `header.php`.

### ✅ D7 ORM в компонентах
Все компоненты используют `ElementTable::getList()` вместо устаревшего `CIBlockElement`.

---

## Если что-то не работает

| Проблема | Решение |
|----------|---------|
| CSS не грузится | Проверь путь в header.php: `/bitrix/templates/dianomi/css/style.css` |
| Компоненты не найдены | Проверь: `/dianomi/bitrix/local/components/dianomi/` |
| Двойная шапка | Убери `require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php")` из header.php |
| Пустая страница | Открой код страницы (Ctrl+U) — есть ли `<main id="main-content">`? |
| Ошибка 404 | Проверь параметры сайта: папка `/dianomi/`, домен `s277847.h1n.ru/dianomi` |
| Шаблон не привязан | Админка → Настройки → Сайты → Шаблоны сайтов → привяжи "dianomi" |
