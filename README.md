# Dianomi — Сайт партнёра 1С-Битрикс

Сайт для компании Dianomi — интегратора связанных цифровых систем. Развёрнут на 1С-Битрикс: Управление сайтом.

## 📦 Структура проекта

```
bitrix/
├── dianomi/                    ← Оригинальные файлы сайта (reference)
│   ├── *.php                   ← Страницы (index, about, contacts, etc.)
│   ├── header.php / footer.php ← Шаблон-обёртка (DOCTYPE + </body></html>)
│   ├── .htaccess               ← URL rewriting
│   ├── bitrix/                 ← Шаблон + компоненты
│   │   ├── templates/dianomi/  ← Шаблон сайта
│   │   └── local/components/   ← Кастомные компоненты
│   └── docs/                   ← Документация
├── dianomi-solution/           ← Bitrix solution module (source)
│   ├── install/index.php       ← Installer модуля
│   ├── components/             ← 8 кастомных компонентов
│   ├── templates/              ← Шаблон dianomi
│   ├── css/, js/, img/         ← Ресурсы
│   └── solution.php            ← Манифест решения
├── wizard/dianomi/             ← МАСТЕР для установки через "Загрузить мастер"
│   ├── .wizard                 ← Манифест мастера
│   ├── wizard.php              ← Класс CWizard
│   ├── install/                ← Шаги установки
│   ├── templates/              ← Шаблон
│   ├── components/             ← Компоненты
│   └── css/, js/, img/         ← Ресурсы
└── deploy/                     ← Артефакты для деплоя
    ├── dianomi-site.zip        ← Мастер (загрузить через "Загрузить мастер")
    └── INSTALLATION-GUIDE.md   ← Подробная инструкция
```

## 🚀 Установка через мастер (рекомендуется)

1. В админке Bitrix перейди: **Настройки → Настройки продукта → Структура сайта → Список мастеров**
2. Нажми **"+ Загрузить мастер"**
3. Выбери файл `deploy/dianomi-site.zip`
4. После загрузки нажми **"Установить"** рядом с **Dianomi Site**
5. Мастер автоматически:
   - Создаст сайт `dianomi`
   - Создаст 7 инфоблоков с свойствами
   - Скопирует все файлы
   - Привяжет шаблон
6. Открой `https://s277847.h1n.ru/dianomi/`

## 📋 Ручная установка

См. `deploy/INSTALLATION-GUIDE.md`

## 🧩 Компоненты

| Компонент | Назначение |
|-----------|-----------|
| `dianomi:hero` | Hero-секция с счётчиками |
| `dianomi:problems` | Блок проблем |
| `dianomi:solutions` | Блок решений |
| `dianomi:before-after` | До/После |
| `dianomi:approach` | Подход (шаги) |
| `dianomi:about-company` | О компании |
| `dianomi:faq` | FAQ |
| `dianomi:cta-form` | CTA-форма |

## 📄 Страницы

| Файл | URL |
|------|-----|
| `index.php` | `/` |
| `business-systems.php` | `/business-systems.php` |
| `bitrix24.php` | `/bitrix24.php` |
| `bitrix24-prices.php` | `/bitrix24-prices.php` |
| `1c-bitrix.php` | `/1c-bitrix.php` |
| `1c-bitrix-prices.php` | `/1c-bitrix-prices.php` |
| `web-systems.php` | `/web-systems.php` |
| `data-bi.php` | `/data-bi.php` |
| `about.php` | `/about.php` |
| `contacts.php` | `/contacts.php` |
| `project.php` | `/project.php` |

## ⚙️ Ключевые особенности

- **D7 ORM** — все компоненты используют `ElementTable::getList()`
- **Статическое меню** — `bitrix:menu` с шаблоном `megamenu`
- **Пути от корня** — ресурсы подключаются как `/bitrix/templates/dianomi/...`
- **Header без require** — шаблон header.php НЕ содержит `require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php")`
- **Footer закрывает HTML** — footer.php содержит `</body></html>`

## 📁 Документация

- `dianomi/docs/README.md` — обзор проекта
- `dianomi/docs/SPECIFICATION.md` — спецификация
- `dianomi/docs/ARCHITECTURE.md` — архитектура
- `dianomi/docs/COMPONENTS.md` — компоненты
- `dianomi/docs/PAGE-BLOCKS.md` — блоки страниц
- `dianomi/docs/MAIN-PAGE-ANALYSIS.md` — анализ главной страницы
