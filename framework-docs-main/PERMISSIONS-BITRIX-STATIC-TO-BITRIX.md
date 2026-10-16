# Правила переноса статичного HTML-сайта на 1С-Битрикс

> Документ создан на основе официальной документации 1С-Битрикс Framework (framework-docs-main).  
> Все правила обязательны к соблюдению при переносе статичного сайта на HTML в 1С-Битрикс.

---

## 1. Структура проекта

### 1.1. Расположение файлов

```
/bitrix/                          ← Системные файлы (НЕ ИЗМЕНЯТЬ!)
/local/                           ← Все пользовательские изменения
/upload/                          ← Загружаемые файлы (фото, документы)
/index.php                        ← Главная страница
```

**Правило:** Все изменения хранятся **только** в `/local/`. Файлы в `/bitrix/` не редактируются.

### 1.2. Структура шаблона сайта

```
/local/templates/dianomi/
├── description.php           ← Описание шаблона
├── header.php                ← Шапка сайта (до начала контента)
├── footer.php                ← Подвал сайта (после конца контента)
├── styles.css                ← Стили содержимого (для визуального редактора)
├── template_styles.css       ← Стили каркаса (шапка, подвал, сетка)
├── img/                      ← Изображения шаблона
├── js/                       ← JavaScript шаблона
├── css/                      ← CSS шаблона
└── page_templates/           ← Шаблоны страниц (опционально)
```

### 1.3. Структура компонентов

```
/local/components/dianomi/block.name/
├── .description.php          ← Описание для админки
├── .parameters.php           ← Параметры компонента
├── class.php                 ← PHP-логика
├── templates/
│   └── .default/
│       ├── template.php      ← HTML-шаблон вывода
│       ├── style.css         ← Стили компонента
│       └── script.js         ← JS компонента
└── lang/ru/messages.php      ← Локализация
```

---

## 2. Шаблон страницы

### 2.1. Обязательная структура каждой страницы

```php
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Заголовок страницы для <title>');
?>

<!-- Контент страницы -->

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
```

### 2.2. Header.php — Шапка сайта

```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialcharsbx(LANGUAGE_ID) ?>">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
</head>
<body>
    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
    <!-- Ваш HTML-код шапки -->
```

### 2.3. Footer.php — Подвал сайта

```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
    <!-- Ваш HTML-код подвала -->
</body>
</html>
```

### 2.4. Метаданные страницы — .section.php

Для каждой директории с страницами создайте `.section.php`:

```php
<?php
$sSectionName = 'Название раздела';
$arDirProperties = [
    'description' => 'SEO описание страницы',
    'keywords' => 'Ключевые слова',
    'title' => 'Заголовок вкладки браузера',
];
?>
```

---

## 3. Перенос HTML-кода

### 3.1. Преобразование HTML в PHP-шаблон

**Было (статичный HTML):**
```html
<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>...</header>
    <main>
        <h1>Привет, мир!</h1>
    </main>
    <footer>...</footer>
    <script src="/js/main.js"></script>
</body>
</html>
```

**Стало (header.php):**
```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialcharsbx(LANGUAGE_ID) ?>">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/style.css">
</head>
<body>
    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
    <header>
```

**Стало (footer.php):**
```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
    <footer>
        <!-- Подвал -->
    </footer>
</body>
</html>
```

**Стало (index.php — страница):**
```php
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Главная страница');
?>
<main>
    <h1>Привет, мир!</h1>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
```

### 3.2. Пути к ресурсам

| Было | Стало |
|------|-------|
| `/css/style.css` | `<?= SITE_TEMPLATE_PATH ?>/css/style.css` |
| `/img/logo.png` | `<?= SITE_TEMPLATE_PATH ?>/img/logo.png` |
| `/js/main.js` | `<?= SITE_TEMPLATE_PATH ?>/js/main.js` |
| `/upload/photo.jpg` | `<?= SITE_DIR ?>upload/photo.jpg` |

**Важно:** Используйте константы:
- `SITE_TEMPLATE_PATH` — путь к текущему шаблону от корня сайта
- `SITE_DIR` — путь к текущему сайту (например, `/`)
- `DOCUMENT_ROOT` — физический путь к корню сайта

### 3.3. Подключение CSS и JS

**CSS:**
```php
<?php
// В header.php или на странице
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/additional.css');
?>
```

**JS:**
```php
<?php
// На странице
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/custom.js');
?>
```

Или в `.js` файле компонента — Битрикс подключит автоматически.

---

## 4. Динамический контент

### 4.1. Информационные блоки (Инфоблоки)

Для динамического контента (новости, товары, статьи) используйте инфоблоки.

**Создание инфоблока через классическое API (в модуле или установке):**
```php
<?php
\Bitrix\Main\Loader::includeModule('iblock');

// Создание типа инфоблока
$iblockType = new \CIBlockType;
$iblockType->Add([
    'ID' => 'news',
    'SECTIONS' => 'Y',
    'IN_RSS' => 'Y',
    'LANG' => [
        'ru' => ['NAME' => 'Новости', 'ELEMENT_NAME' => 'Новость'],
    ],
]);

// Создание инфоблока
$iblock = new \CIBlock;
$iblock->Add([
    'IBLOCK_TYPE_ID' => 'news',
    'NAME' => 'Новости сайта',
    'API_CODE' => 'News',
    'LID' => ['s1'],
    'GROUP_ID' => [2 => \CIBlockRights::PUBLIC_READ],
]);
?>
```

### 4.2. ORM D7 — работа с элементами

```php
<?php
use Bitrix\Iblock\Elements\ElementNewsTable;

// Получение элементов
$elements = ElementNewsTable::getList([
    'select' => ['ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DATE_ACTIVE_FROM'],
    'filter' => [
        'IBLOCK_ID' => 1,
        'ACTIVE' => 'Y',
        '=CODE' => 'some-code',  // точный фильтр
    ],
    'order' => ['DATE_ACTIVE_FROM' => 'DESC'],
    'limit' => 10,
])->fetchAll();

// Создание элемента
$element = ElementNewsTable::createObject();
$element->setName('Новая новость');
$element->setPreviewText('Текст новости');
$element->save();

// Обновление элемента
$element = ElementNewsTable::getByPrimary($id)->fetchObject();
$element->setName('Обновлённый заголовок');
$element->save();

// Удаление элемента
ElementNewsTable::delete($id);
?>
```

### 4.3. Компоненты для вывода контента

Используйте штатные компоненты Битрикс:

```php
<?php
// Вывод списка новостей
$APPLICATION->IncludeComponent(
    'bitrix:news.list',
    '',
    [
        'IBLOCK_ID' => '1',
        'NEWS_COUNT' => '10',
        'SORT_BY1' => 'DATE_ACTIVE_FROM',
        'SORT_ORDER1' => 'DESC',
        'FIELD' => ['NAME', 'PREVIEW_TEXT'],
        'FILTER_NAME' => '',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'Y',
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => '3600',
    ],
    $component,
    ['HIDE_ICONS' => 'Y']
);

// Вывод детальной новости
$APPLICATION->IncludeComponent(
    'bitrix:news.detail',
    '',
    [
        'IBLOCK_ID' => '1',
        'ELEMENT_CODE' => $_REQUEST['ELEMENT_CODE'] ?? '',
        'SET_TITLE' => 'Y',
        'SET_STATUS_CODE' => 'Y',
        'USE_SHARE' => 'N',
    ],
    $component
);
?>
```

### 4.4. Создание пользовательского компонента

```php
<?php
// /local/components/dianomi/hero/block/class.php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class DianomiHeroBlock extends \CBitrixComponent
{
    public function prepareComponentParams($arParams)
    {
        $arParams['TITLE'] ??= '';
        $arParams['DESCRIPTION'] ??= '';
        $arParams['BUTTON_TEXT'] ??= 'Подробнее';
        return $arParams;
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->initResult();
            $this->includeComponentTemplate();
        }
    }

    private function initResult(): void
    {
        $this->arResult['TITLE'] = $this->arParams['TITLE'];
        $this->arResult['DESCRIPTION'] = $this->arParams['DESCRIPTION'];
        $this->arResult['BUTTON_TEXT'] = $this->arParams['BUTTON_TEXT'];
    }
}
?>
```

**Шаблон компонента (template.php):**
```php
<?php
use Bitrix\Main\Localization\Loc;
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<section class="hero">
    <div class="hero__content">
        <h1 class="hero__title"><?= htmlspecialcharsbx($arResult['TITLE']) ?></h1>
        <p class="hero__description"><?= htmlspecialcharsbx($arResult['DESCRIPTION']) ?></p>
        <a href="#" class="hero__button"><?= htmlspecialcharsbx($arResult['BUTTON_TEXT']) ?></a>
    </div>
</section>
```

**Описание компонента (.description.php):**
```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = [
    'NAME' => 'Hero блок',
    'DESCRIPTION' => 'Hero-секция на главной странице',
    'PATH' => [
        'ID' => 'dianomi',
        'NAME' => 'Dianomi',
    ],
];
?>
```

**Параметры компонента (.parameters.php):**
```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    'PARAMETERS' => [
        'TITLE' => [
            'NAME' => 'Заголовок',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'DESCRIPTION' => [
            'NAME' => 'Описание',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'BUTTON_TEXT' => [
            'NAME' => 'Текст кнопки',
            'TYPE' => 'STRING',
            'DEFAULT' => 'Подробнее',
        ],
    ],
];
?>
```

---

## 5. Меню навигации

### 5.1. Статическое меню

Создайте файл `.top.menu.php` в корне сайта:

```php
<?php
$aMenuLinks = [
    ['Главная', '/', [], [], ''],
    ['О компании', '/about/', [], [], ''],
    ['Услуги', '/services/', [], [], ''],
    ['Контакты', '/contacts/', [], [], ''],
];
?>
```

### 5.2. Вывод меню на странице

```php
<?php
$APPLICATION->IncludeComponent(
    'bitrix:menu',
    'horizontal_top',
    [
        'ROOT_MENU_TYPE' => 'top',
        'MAX_LEVEL' => '1',
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => '3600',
        'MENU_CACHE_USE_IBLOCK' => 'N',
        'HIDE_NEWS' => 'N',
        'ALLOW_MULTI_SELECT' => 'N',
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
?>
```

---

## 6. Безопасность

### 6.1. Экранирование вывода

**Правило:** Все внешние данные должны быть экранированы перед выводом в HTML.

```php
<!-- Безопасный вывод -->
<h1><?= \Bitrix\Main\Text\HtmlFilter::encode($arResult['TITLE']) ?></h1>
<input type="text" value="<?= htmlspecialcharsbx($arResult['VALUE']) ?>" />

<!-- Для атрибутов -->
<img src="<?= htmlspecialcharsbx($arResult['IMAGE_SRC']) ?>" alt="<?= htmlspecialcharsbx($arResult['ALT']) ?>" />

<!-- Для JavaScript -->
<script>
    var title = <?= \Bitrix\Main\Web\Json::encode($arResult['TITLE']) ?>;
</script>
```

**Важно:** Значения в `$arResult` уже экранированы Битрикс автоматически. Вывод `<?= $arResult['NAME'] ?>` безопасен от XSS.

### 6.2. Защита от прямого доступа

**Правило:** Каждый PHP-файл должен содержать защиту:

```php
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
```

### 6.3. CSRF-защита

Для форм используйте:
```php
<?php echo bitrix_sessid_post(); ?>
```

Для AJAX-запросов:
```javascript
BX.ajax.runAction('namespace:component.action', {
    data: {
        // данные
    }
});
```

---

## 7. Производительность и кэширование

### 7.1. Кэширование компонентов

```php
<?php
public function executeComponent()
{
    if ($this->startResultCache()) {
        $this->initResult();
        if (empty($this->arResult)) {
            $this->abortResultCache();
            ShowError('Данные не найдены');
            return;
        }
        $this->includeComponentTemplate();
    }
}
?>
```

### 7.2. Кэширование ORM-запросов

```php
<?php
$elements = ElementNewsTable::getList([
    'select' => ['ID', 'NAME'],
    'filter' => ['IBLOCK_ID' => 1],
    'cache' => ['ttl' => 3600, 'cache_joins' => true],
])->fetchAll();
?>
```

### 7.3. Оптимизация запросов

- Выбирайте только нужные поля (`select`)
- Используйте точные фильтры (`=CODE` вместо `%CODE%`)
- Избегайте запросов в циклах
- Используйте `nTopCount` вместо `nPageSize` для топ-N элементов

---

## 8. Стили и изображения

### 8.1. Подключение CSS шаблона

```php
<?php
// В header.php
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');
?>
```

### 8.2. Изображения

Пути к изображениям в шаблоне:
```php
<img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.png" alt="Logo">
```

Для изображений из инфоблоков:
```php
<?php
if (!empty($arResult['PICTURE'])) {
    $imageSrc = \CFile::GetPath($arResult['PICTURE']);
    echo '<img src="' . htmlspecialcharsbx($imageSrc) . '" alt="">';
}
?>
```

### 8.3. Ресайз изображений

```php
<?php
use Bitrix\Main\IO\File;
use Bitrix\Main\Data\Cache;

$arResize = \CFile::ResizeImageGet(
    $arResult['PICTURE'],
    ['width' => 800, 'height' => 600],
    BX_RESIZE_IMAGE_EXACT
);
?>
```

---

## 9. Мультисайт

### 9.1. Код инициализации для конкретного сайта

```
/local/php_interface/s1/init.php
```

### 9.2. Определение текущего сайта

```php
<?php
$siteId = \Bitrix\Main\Application::getInstance()->getContext()->getSite();
$languageId = \Bitrix\Main\Application::getInstance()->getContext()->getLanguage();
?>
```

---

## 10. События и хуки

### 10.1. Подключение обработчика событий

В `/local/php_interface/init.php`:
```php
<?php
\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'main',
    'OnPageStart',
    static function (): void {
        // Код, выполняемый при каждой загрузке страницы
    }
);

\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'iblock',
    'OnBeforeIBlockElementAdd',
    static function (\Bitrix\Main\Event $event): \Bitrix\Main\EventResult {
        $fields = $event->getParameter('fields');
        // Обработка перед добавлением элемента
        return new \Bitrix\Main\EventResult(\Bitrix\Main\EventResult::SUCCESS);
    }
);
?>
```

---

## 11. Чек-лист переноса

### Этап 1: Подготовка
- [ ] Создать шаблон сайта в `/local/templates/dianomi/`
- [ ] Настроить `header.php` и `footer.php`
- [ ] Создать `description.php` с описанием шаблона
- [ ] Перенести CSS в `/local/templates/dianomi/css/`
- [ ] Перенести JS в `/local/templates/dianomi/js/`
- [ ] Перенести изображения в `/local/templates/dianomi/img/`

### Этап 2: Страницы
- [ ] Создать PHP-файлы страниц вместо HTML
- [ ] Добавить `require header.php` и `require footer.php`
- [ ] Настроить заголовки через `$APPLICATION->SetTitle()`
- [ ] Создать `.section.php` для SEO-метаданных
- [ ] Настроить хлебные крошки через `$APPLICATION->AddChainItem()`

### Этап 3: Динамический контент
- [ ] Создать типы инфоблоков через админку или код
- [ ] Создать инфоблоки для контента
- [ ] Настроить свойства инфоблоков
- [ ] Создать/настроить компоненты для вывода контента
- [ ] Настроить кэширование компонентов

### Этап 4: Навигация
- [ ] Создать файлы меню `.top.menu.php`
- [ ] Подключить компоненты меню
- [ ] Настроить активные пункты меню

### Этап 5: Безопасность и оптимизация
- [ ] Проверить экранирование всех выводов
- [ ] Настроить кэширование
- [ ] Проверить пути к ресурсам (SITE_TEMPLATE_PATH)
- [ ] Проверить защиту от прямого доступа
- [ ] Протестировать composite-сайт

---

## 12. Шпаргалка по константам и объектам

| Константа/Объект | Назначение |
|------------------|-----------|
| `SITE_TEMPLATE_PATH` | Путь к текущему шаблону от корня сайта |
| `SITE_DIR` | Путь к текущему сайту (например, `/`) |
| `LANGUAGE_ID` | Текущий язык сайта |
| `DOCUMENT_ROOT` | Физический путь к корню сайта |
| `$APPLICATION` | Объект CMain — управление страницей |
| `$USER` | Объект CUser — информация о пользователе |
| `CBitrixComponent` | Базовый класс компонента |
| `\CBitrixComponent` | Старое API компонента |

| Метод `$APPLICATION` | Назначение |
|---------------------|-----------|
| `SetTitle()` | Установить заголовок `<title>` |
| `ShowTitle()` | Вывести заголовок в `<title>` |
| `ShowTitle(false)` | Вывести заголовок в `<h1>` |
| `ShowHead()` | Вывести `<head>` (CSS, мета-теги) |
| `ShowPanel()` | Вывести панель администратора |
| `IncludeComponent()` | Подключить компонент |
| `AddChainItem()` | Добавить пункт в хлебные крошки |
| `SetPageProperty()` | Установить свойство страницы |
| `GetPageProperty()` | Получить свойство страницы |
| `SetAdditionalCSS()` | Добавить CSS-файл |
| `AddHeadScript()` | Добавить JS-файл в `<head>` |

---

## 13. Запрещённые действия

1. **Не редактировать файлы** в `/bitrix/modules/`, `/bitrix/components/bitrix/`, `/bitrix/templates/`
2. **Не писать прямые SQL-запросы** — использовать ORM D7 или документированное API
3. **Не смешивать HTML и PHP-логику** — разделять логику (class.php) и представление (template.php)
4. **Не выводить неэкранированные данные** — всегда использовать `htmlspecialcharsbx()` или `HtmlFilter::encode()`
5. **Не дублировать файлы** между `/local/` и `/bitrix/`
6. **Не использовать `die()`/`exit()`** на кешируемых страницах
7. **Не отключать CSRF-защиту** для изменяющих данных действий
8. **Не хранить секреты** в коде — использовать настройки и параметры

---

## 14. Рекомендуемые паттерны

### Паттерн: Блок-секция как компонент

Каждую смысловую секцию страницы оформлять как компонент:

```
/local/components/dianomi/
├── hero/
├── features/
├── testimonials/
├── cta/
└── partners/
```

### Паттерн: Разделение логики и представления

```php
// class.php — только PHP-логика
class DianomiHero extends \CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->arResult = $this->getData();
            $this->includeComponentTemplate();
        }
    }

    private function getData(): array
    {
        // Загрузка данных из инфоблока или других источников
        return [...];
    }
}

// template.php — только HTML-вывод
<section class="hero">
    <h1><?= htmlspecialcharsbx($arResult['TITLE']) ?></h1>
</section>
```

### Паттерн: Переиспользование шаблона

```php
// Проверка текущей страницы
if ($APPLICATION->GetCurPage(false) === SITE_DIR . 'index.php') {
    // Стили или контент только для главной
}
```

---

## 15. Структура проекта после переноса

```
/local/
├── templates/
│   └── dianomi/
│       ├── description.php
│       ├── header.php
│       ├── footer.php
│       ├── styles.css
│       ├── template_styles.css
│       ├── css/
│       │   ├── style.css
│       │   └── custom.css
│       ├── js/
│       │   └── main.js
│       ├── img/
│       │   ├── logo.png
│       │   └── ...
│       └── page_templates/
├── components/
│   └── dianomi/
│       ├── hero/
│       ├── features/
│       ├── testimonials/
│       └── ...
├── modules/
│   └── dianomi.site/
│       └── ...
├── php_interface/
│   └── init.php
└── blocks/
    └── ...
```

---

*Документ создан на основе официальной документации 1С-Битрикс Framework.*  
*Последнее обновление: 2026-10-16*
