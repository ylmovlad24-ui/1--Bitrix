# Документация по компонентам Dianomi для 1С-Битрикс

## ✅ Что соответствует документации разработчика

### 1. **Безопасный вывод данных**
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
│   ├── .description.php      # ✅ Описание компонента
│   ├── .parameters.php       # ✅ Параметры компонента
│   ├── class.php             # ✅ Логика компонента
│   ├── lang/ru/              # ✅ Языковые файлы
│   │   └── .parameters.php
│   └── templates/
│       └── .default/
│           ├── template.php  # ✅ Шаблон
│           └── style.css     # ✅ Стили
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
    'CACHE_SETTINGS' => array(
        'DEFAULT' => array(),
    ),
);
```

### 5. **Использование ElementTable (D7 ORM)**
```php
// ✅ ПРАВИЛЬНО - современный API
$res = ElementTable::getList(array(
    'filter' => array(
        'IBLOCK_CODE' => 'page_hero',
        'ACTIVE' => 'Y',
    ),
    'select' => array(
        'ID',
        'NAME',
        'PROPERTY_TITLE',
    ),
    'limit' => 1,
));
$arElement = $res->fetch();

// ❌ УСТАРЕВШИЙ API
$res = CIBlockElement::GetList(...);
$arElement = $res->GetNext();
```

### 6. **Правильная структура class.php**
```php
class CBitrixComponentDianomiHero extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_hero';
    
    public function prepareResult()
    {
        // Логика компонента
    }
    
    protected function checkRights()
    {
        // Проверка прав
    }
    
    protected function getIblockID()
    {
        // Получение ID инфоблока
    }
    
    public function getAction()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
    }
}
```

### 7. **Проверка прав**
```php
// ✅ ПРАВИЛЬНО - проверка прав на чтение инфоблока
protected function checkRights()
{
    global $USER;
    
    if (!$USER->isAuthorized()) {
        return false;
    }
    
    $ibID = $this->getIblockID();
    if (!$ibID) {
        return false;
    }
    
    return true;
}
```

### 8. **Валидация входных данных**
```php
// ✅ ПРАВИЛЬНО - валидация PAGE_CODE
protected function getElementData()
{
    $pageCode = $this->arParams['PAGE_CODE'] ?? 'index';
    
    $arAllowedPages = array('index', 'about', 'contacts', 'business-systems');
    if (!in_array($pageCode, $arAllowedPages)) {
        $pageCode = 'index';
    }
    
    // ...
}
```

### 9. **Правильное использование SITE_ID**
```php
// ✅ ПРАВИЛЬНО - использование SITE_ID
$res = IblockTable::getList(array(
    'filter' => array(
        'CODE' => self::CODE_IBLOCK,
        'SITE_ID' => SITE_ID,
    ),
    'select' => array('ID'),
    'limit' => 1,
));
```

### 10. **Параметры кэширования**
```php
// ✅ ПРАВИЛЬНО - параметры кэширования в .parameters.php
$arComponentParameters = array(
    'CACHE_SETTINGS' => array(
        'DEFAULT' => array(),
    ),
);
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
$arAllowedPages = array('index', 'about', 'contacts');
if (!in_array($pageCode, $arAllowedPages)) {
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
ElementTable::getList(array(
    'select' => array('ID', 'NAME', 'PROPERTY_*'),
    'filter' => array('IBLOCK_CODE' => 'page_hero'),
    'limit' => 1,
))

// ❌ НЕПРАВИЛЬНО - выбираем всё
ElementTable::getList(array(
    'select' => array('*'),
    'filter' => array('IBLOCK_CODE' => 'page_hero'),
))
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
    
    public function prepareResult()
    {
        // Логика компонента
    }
    
    protected function checkRights()
    {
        // Проверка прав
    }
    
    public function getAction()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
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
