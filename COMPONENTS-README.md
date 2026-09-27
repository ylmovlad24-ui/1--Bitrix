# Документация по компонентам Dianomi для 1С-Битрикс

## ✅ Что исправлено

### 1. **Использование безопасного вывода данных**
```php
// ✅ ПРАВИЛЬНО - данные экранируются
htmlspecialcharsbx($arElement["PROPERTY_TITLE_VALUE"])

// ❌ НЕБЕЗОПАСНО - XSS-уязвимость
<?=$arElement["PROPERTY_TITLE_VALUE"]?>
```

### 2. **Правильная структура компонентов**
```
local/components/dianomi/
├── hero/
│   ├── .description.php      # Описание компонента
│   ├── .parameters.php       # Параметры компонента
│   ├── class.php             # Логика компонента
│   └── templates/
│       └── .default/
│           ├── template.php  # Шаблон
│           └── style.css     # Стили
```

### 3. **Использование $arResult в шаблонах**
```php
// ✅ ПРАВИЛЬНО
<?php foreach ($arResult['PROBLEMS'] as $problem): ?>
    <?=$problem['TITLE']?>
<?php endforeach; ?>

// ❌ НЕПРАВИЛЬНО - прямое обращение к БД в шаблоне
<?php $res = CIBlockElement::GetList(...); ?>
```

### 4. **Правильное подключение CSS**
```php
// ✅ ПРАВИЛЬНО - через .parameters.php
$arComponentParameters = array(
    'PARAMETERS' => array(
        'STYLE' => array(
            'PARENT' => 'STYLES',
            'NAME' => 'Стили компонента',
            'TYPE' => 'CUSTOM',
            'DEFAULT' => '',
            'REFS' => array(
                'DEFAULT' => 'Стандартные',
            ),
        ),
    ),
);
```

### 5. **Использование CIBlockElement правильно**
```php
// ✅ ПРАВИЛЬНО - с проверкой прав
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_CODE" => "page_hero", "ACTIVE" => "Y"),
    false,
    false,
    array("ID", "NAME", "PROPERTY_*")
);

// Проверка прав
if (!$USER->IsAuthorized()) {
    $this->abortStep();
    return;
}
```

## 📋 Использование компонентов

### Подключение компонента на странице
```php
<?$APPLICATION->IncludeComponent(
    "dianomi:hero",
    ".default",
    array(
        "PAGE_CODE" => "index",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    ),
    $component
);?>
```

### Параметры компонента
- `PAGE_CODE` - код страницы для загрузки данных
- `CACHE_TYPE` - тип кеширования (A/Y/N)
- `CACHE_TIME` - время кеширования в секундах

## 🔒 Безопасность

### 1. Экранирование данных
```php
htmlspecialcharsbx($arElement["PROPERTY_TITLE_VALUE"])
```

### 2. Проверка прав
```php
if (!$USER->isAuthorized()) {
    $this->abortStep();
    return;
}
```

### 3. Валидация входных данных
```php
$pageCode = $this->arParams['PAGE_CODE'] ?? 'index';
if (!in_array($pageCode, array('index', 'about', 'contacts'))) {
    $pageCode = 'index';
}
```

## ⚡ Производительность

### 1. Кеширование
```php
// В .parameters.php
$arComponentParameters = array(
    "CACHE_UPDATED" => array(...),
    "CACHE_TYPE" => array(...),
    "CACHE_TIME" => array(...),
);
```

### 2. Оптимизация запросов
```php
// ✅ ПРАВИЛЬНО - выбираем только нужные поля
CIBlockElement::GetList(array(), array(), false, false, array("ID", "NAME"))

// ❌ НЕПРАВИЛЬНО - выбираем всё
CIBlockElement::GetList(array(), array(), false, false)
```

## 📝 Стандарты кодирования

### 1. Именование переменных
```php
$arElement - массив элементов
$arItem - элемент массива
$arResult - результат компонента
$arProperties - свойства инфоблока
```

### 2. Именование констант
```php
const CODE_IBLOCK = 'page_hero';
const NAME_COMPONENT = 'Hero Section';
```

### 3. Структура class.php
```php
class CBitrixComponentDianomiHero extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_hero';
    
    public function executeComponent()
    {
        // Логика компонента
    }
    
    protected function checkRights()
    {
        // Проверка прав
    }
    
    protected function getElementData()
    {
        // Получение данных
    }
}
```

## 🚀 Деплой

### 1. Установка модуля
1. Скопировать `/local/modules/dianomi/` на сервер
2. Админка → Настройки → Продукты → Модули
3. Найти "Dianomi Components" и нажать "Установить"

### 2. Создание инфоблоков
1. Создать инфоблоки через Админку
2. Заполнить данными

### 3. Проверка работы
1. Открыть главную страницу
2. Проверить: зелёная иконка композита
3. Проверить: `<!-- composite -->` в исходном коде

## 📚 Ссылки

- [Официальная документация Bitrix](https://dev.1c-bitrix.ru/)
- [Создание компонентов](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=37&CHAPTER_ID=08446)
- [Работа с инфоблоками](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=36&CHAPTER_ID=08447)
- [Безопасность](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=38&CHAPTER_ID=08448)
