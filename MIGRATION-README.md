# Миграция сайта Dianomi на 1С-Битрикс CMS

## Структура проекта

```
bitrix/
├── index.php                    (главная страница)
├── about.php                    (о компании)
├── contacts.php                 (контакты)
├── business-systems.php         (системы управления бизнесом)
├── bitrix24.php                 (Битрикс24)
├── bitrix24-prices.php          (тарифы Битрикс24)
├── web-systems.php              (веб-системы)
├── 1c-bitrix.php                (1С-Битрикс)
├── 1c-bitrix-prices.php         (тарифы 1С-Битрикс)
├── data-bi.php                  (данные и BI-аналитика)
├── 404.php                      (страница ошибки)
├── robots.txt
├── sitemap.xml
├── .htaccess                    (защита и кеширование)
│
├── css/
│   └── style.css                (общие стили сайта)
│
├── js/
│   └── main.js                  (общая JS-логика)
│
├── img/
│   ├── logo-dianomi.svg
│   ├── logo-bitrix.svg
│   ├── logo-partner-badge.svg
│   ├── og-default.jpg
│   ├── og-business-systems.jpg
│   └── og-web-systems.jpg
│
└── local/
    ├── templates/
    │   └── dianomi/             (шаблон сайта)
    │       ├── .description.php
    │       ├── .style.php
    │       ├── template.php
    │       ├── header.php
    │       ├── footer.php
    │       └── lang/ru/
    │           ├── header.php
    │           └── footer.php
    │
    ├── components/
    │   └── bitrix/
    │       ├── menu/
    │       │   └── templates/
    │       │       └── megamenu/
    │       │           └── template.php
    │       └── form/
    │           └── templates/
    │               └── project_form/
    │                   └── template.php
    │
    └── components/
        └── dianomi/             (кастомные компоненты)
            ├── hero/
            │   └── .default/
            │       └── template.php
            ├── problems/
            │   └── .default/
            │       └── template.php
            ├── solutions/
            │   └── .default/
            │       └── template.php
            ├── before-after/
            │   └── .default/
            │       └── template.php
            ├── approach/
            │   └── .default/
            │       └── template.php
            ├── about-company/
            │   └── .default/
            │       └── template.php
            ├── faq/
            │   └── .default/
            │       └── template.php
            └── cta-form/
                └── .default/
                    └── template.php
```

## Установка

### 1. Установить OpenServer
- Скачать: https://open-server.ru/
- Установить в `C:\OpenServer\domains\dianomi.local`

### 2. Установить Bitrix Business
- Скачать: https://www.1c-bitrix.ru/download/
- Распаковать в `C:\OpenServer\domains\dianomi.local\`
- Пройти мастер установки

### 3. Перенести файлы
- Скопировать всю структуру из этого проекта в корень сайта
- CSS, JS и изображения уже в правильных местах

### 4. Настроить композит
- Админка → Настройки → Настройки продукта → Композитный режим → Включить
- Время жизни кеша: 3600 сек

### 5. Создать инфоблоки
Через Админку → Контент → Информационные блоки:
- `page_hero` - Hero-блоки
- `page_problems` - Проблемы
- `page_solutions` - Решения
- `page_before_after` - До/После
- `page_approach` - Подход
- `page_about` - О компании
- `page_faq` - FAQ
- `page_cta` - CTA

### 6. Заполнить контент
Для каждой страницы создать элементы в соответствующих инфоблоках с кодом страницы (index, about, contacts и т.д.)

## Управление контентом

Все блоки страниц управляются через Админку:
1. Контент → Информационные блоки
2. Выбрать нужный инфоблок
3. Создать/отредактировать элемент

Например, для изменения hero-секции на главной:
- Инфоблок `page_hero`
- Элемент с кодом `index`
- Изменить TITLE, DESCRIPTION, COUNTER_1 и т.д.

## Компоненты

### dianomi:hero
Hero-секция с заголовком, описанием, счётчиками и списком преимуществ.

### dianomi:problems
Блок "Узнаёте себя?" с карточками проблем.

### dianomi:solutions
Карточки решений.

### dianomi:before-after
Блок "До/После" - показывает изменения после проекта.

### dianomi:approach
Шаги "Наш подход: от картины к деталям".

### dianomi:about-company
Блок "О Dianomi" с описанием компании.

### dianomi:faq
FAQ-аккордеон с вопросами-ответами.

### dianomi:cta-form
CTA-блок с формой обратной связи.

## SEO

- Title, description, keywords настраиваются для каждой страницы
- Open Graph теги для социальных сетей
- robots.txt и sitemap.xml в корне сайта
- ЧПУ включается в настройках продукта

## Безопасность

- .htaccess защищает директории /local/, /bitrix/, /upload/
- XSS защита через заголовки
- CSRF защита через компонент bitrix:form

## Производительность

- Композитная технология для кеширования
- Время кеширования: 3600 сек
- Минификация CSS/JS
- Кеширование изображений: 1 год
