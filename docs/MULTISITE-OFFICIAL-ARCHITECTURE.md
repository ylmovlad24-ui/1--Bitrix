# ✅ Multi-Site Architecture - ОФИЦИАЛЬНАЯ документация Bitrix

## 📌 Важное замечание

Согласно [официальной документации Bitrix](https://dev.1c-bitrix.ru), **НЕЛЬЗЯ**:
- ❌ Копировать папки `/bitrix/`, `/upload/`, `/local/` между сайтами
- ❌ Создавать отдельные установки Bitrix на одной лицензии
- ❌ Создавать папку `bitrix/` внутри каждого сайта

## ✅ Правильная структура (по документации Bitrix)

### Режим 1: На одном домене (рекомендуется для вашего случая)

```
/var/www/site.ru/                    ← DocumentRoot (ОДИН корень)
│
├── bitrix/                          ← ОДНА установка ядра Bitrix
│   ├── modules/                     ← общие модули для всех сайтов
│   ├── components/                  ← общие компоненты
│   ├── templates/                   ← шаблоны всех сайтов
│   │   ├── dianomi/                 ← шаблон для /dianomi/
│   │   │   ├── header.php
│   │   │   ├── footer.php
│   │   │   └── styles.css
│   │   └── shop/                    ← шаблон для /shop/
│   │       ├── header.php
│   │       └── styles.css
│   └── php_interface/
│       ├── init.php                 ← общий код для всех сайтов
│       └── dbconn.php               ← подключение к БД
│
├── upload/                          ← общие загружаемые файлы
│   └── files/
│
├── local/                           ← общие файлы (если есть)
│
├── index.php                        ← сайт s1 (URL: /)
├── about.php
├── contacts.php
│
├── dianomi/                         ← сайт s2 (URL: /dianomi/)
│   ├── index.php
│   ├── prices.php
│   ├── contacts.php
│   └── (ТОЛЬКО файлы страниц!)
│
└── shop/                            ← сайт s3 (URL: /shop/)
    ├── index.php
    ├── catalog.php
    ├── products.php
    └── (ТОЛЬКО файлы страниц!)
```

### Режим 2: На разных доменах (с символическими ссылками)

```
/var/www/site-main/                  ← сайт 1 (site.ru)
├── bitrix/                          ← ядро
├── upload/
├── local/
└── index.php

/var/www/site-shop/                  ← сайт 2 (shop.site.ru)
├── bitrix → /var/www/site-main/bitrix    ← символическая ссылка!
├── upload → /var/www/site-main/upload    ← символическая ссылка!
├── local → /var/www/site-main/local      ← символическая ссылка!
└── index.php
```

## 🔑 Как Bitrix определяет сайт

Система определяет текущий сайт по **двум параметрам**:

### 1. По доменному имени
- При запросе `site.ru` → сравниваем с настройками сайтов
- Можно указать несколько доменов (по строке на каждый)

### 2. По папке сайта
- URL `site.ru/` → сайт с папкой `/`
- URL `site.ru/dianomi/` → сайт с папкой `/dianomi/`
- URL `site.ru/shop/` → сайт с папкой `/shop/`

## ⚙️ Настройка в админке Bitrix

### Сайт 1 (корневой):
| Поле | Значение |
|------|----------|
| Доменное имя | `site.ru` |
| Папка сайта | `/` |
| Путь к корневой папке | (пусто) |
| URL сервера | `site.ru` |

### Сайт 2 (dianomi):
| Поле | Значение |
|------|----------|
| ID | `dianomi` |
| Название | Dianomi Site |
| Доменное имя | (пусто) |
| Папка сайта | `/dianomi/` |
| Путь к корневой папке | (пусто) |
| URL сервера | `site.ru/dianomi/` |

### Сайт 3 (shop):
| Поле | Значение |
|------|----------|
| ID | `shop` |
| Название | Shop Site |
| Доменное имя | (пусто) |
| Папка сайта | `/shop/` |
| Путь к корневой папке | (пусто) |
| URL сервера | `site.ru/shop/` |

## 📁 Что может быть в папке сайта

### ✅ МОЖНО:
- `index.php` - главная страница
- `about.php`, `contacts.php` - другие страницы
- `css/`, `js/`, `img/` - статические файлы сайта
- `.htaccess` - настройки сервера
- `404.php` - страница ошибки

### ❌ НЕЛЬЗЯ:
- `bitrix/` - ядро общее!
- `upload/` - загрузки общие!
- `local/` - файлы общие!
- `php_interface/` - инициализация общая!

## 🔧 Общие файлы для всех сайтов

### `bitrix/php_interface/init.php`

```php
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Определение текущего сайта
$currentSite = '';
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$paths = explode('/', trim($docRoot, '/'));
if (count($paths) > 1) {
    $currentSite = end($paths);
}

// Site-specific initialization
switch ($currentSite) {
    case 'dianomi':
        define('DIANOMI_SITE', true);
        break;
    case 'shop':
        define('SHOP_SITE', true);
        break;
}

// Общие event handlers
AddEventHandler("main", "OnEpilog", function() {
    // Код, выполняемый для всех сайтов
});
```

### `bitrix/php_interface/dbconn.php`

```php
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Общая база данных для всех сайтов
define("DB_HOST", "localhost");
define("DB_USER", "site_ru_user");
define("DB_PASSWORD", "password");
define("DB_NAME", "site_ru_database");

global $DB;
$DB->Connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
```

## 🎯 Когда использовать многосайтовость

### ✅ Подходит:
- Одна команда разработки и администрирования
- Сайты связаны по содержанию
- Нужна авторизация при переходе между сайтами
- Общий контент (каталог, новости)

### ❌ Не подходит (нужны отдельные установки):
- Разные команды поддержки
- Данные одного сайта нельзя показывать в другом
- Независимые проекты

## 📊 Зависимость данных от сайтов

### Всегда привязано к сайту:
- Страницы (`/about/`, `/company/index.php`)
- Заказы интернет-магазина
- Файлы `robots.txt` и `sitemap.xml`
- A/B-тестирование

### Можно привязать к сайтам:
- Информационные блоки
- Баннерная реклама
- Опросы и веб-формы
- Учебные курсы

## 🔒 Важные ограничения

1. **Лицензия:** Нельзя создавать независимые копии с отдельным ядром на одной лицензии
2. **Кэширование:** HTML-кэширование не работает на разных доменах (используйте Композитный сайт)
3. **Агенты:** Общие для всех сайтов, не фильтруются по умолчанию
4. **Статистика:** Собирается по каждому сайту отдельно

## 📝 Чек-лист настройки

- [ ] Создать общую папку `/var/www/site.ru/`
- [ ] Установить Bitrix в корень
- [ ] Создать подпапки для сайтов (`dianomi/`, `shop/`)
- [ ] Поместить файлы страниц в подпапки
- [ ] Настроить сайты в админке (Домен + Папка)
- [ ] Проверить уникальность папок для каждого сайта
- [ ] Настроить Apache (один VirtualHost)
- [ ] Очистить кэш
- [ ] Протестировать каждый сайт

## 📚 Источники

- [Bitrix Multi-Site Documentation](https://dev.1c-bitrix.ru)
- Framework docs: `framework-docs-main/pages/advanced/multisite.md`

---

**Важно:** Эта архитектура соответствует ОФИЦИАЛЬНОЙ документации Bitrix Framework!
