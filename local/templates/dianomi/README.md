# Шаблон сайта Dianomi — 1С-Битрикс

Кастомный шаблон сайта, разработанный строго по документации [1C-Bitrix Framework](https://dev.1c-bitrix.ru).

## 📁 Структура шаблона (по документации)

```
local/templates/dianomi/
├── description.php         # Описание шаблона (обязательно)
├── .styles.php             # Стили визуального редактора (обязательно)
├── header.php              # Шаблон шапки (обязательно)
├── footer.php              # Шаблон подвала (обязательно)
├── images/                 # Папка изображений (рекомендуется)
│   └── logo-dianomi.svg
├── css/                    # Папка CSS
│   └── style.css
├── js/                     # Папка JavaScript
│   └── main.js
└── lang/ru/                # Локализация
    └── messages.php
```

## ✅ Соответствие документации

| Требование из docs | Статус |
|--------------------|--------|
| `description.php` (без точки) | ✅ |
| `$arTemplate` в description.php | ✅ |
| `.styles.php` для визуального редактора | ✅ |
| `header.php` + `footer.php` | ✅ |
| Папка `images/` для изображений | ✅ |
| `Asset::getInstance()->addCss()` для CSS | ✅ |
| `SITE_TEMPLATE_PATH` для ресурсов | ✅ |
| `htmlspecialcharsbx()` для данных | ✅ |
| `B_PROLOG_INCLUDED` защита | ✅ |
| `BX.ready()` для JavaScript | ✅ |

## 📋 Использование

### Подключение CSS

```php
<?php Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css'); ?>
```

### Изображения

```html
<img src="<?= htmlspecialcharsbx(SITE_TEMPLATE_PATH . '/images/logo.svg') ?>" alt="Логотип сайта">
```

### Ссылки

```php
<a href="<?= htmlspecialcharsbx(SITE_DIR) ?>">Главная</a>
```

## 📚 Документация

- [Шаблоны сайтов](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=37&CHAPTER_ID=02&LESSON_PATH=3884)
- [Минимальный шаблон](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=37&CHAPTER_ID=02&LESSON_PATH=3884#minimal-template)
