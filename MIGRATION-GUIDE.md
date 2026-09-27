# Миграция сайта Dianomi на 1С-Битрикс CMS

## Что создано

### 1. Структура шаблона
- `/local/templates/dianomi/` — кастомный шаблон сайта
  - `header.php` — шапка с навигацией и мегамею
  - `footer.php` — подвал
  - `template.php` — обёртка контента

### 2. Компоненты навигации
- `/local/components/bitrix/menu/templates/megamenu/` — мегамею

### 3. Компоненты блоков страниц
Каждый компонент содержит:
- `template.php` — HTML-шаблон
- `style.css` — стили компонента (подключаются автоматически)

- `dianomi:hero` — hero-секция
- `dianomi:problems` — блок "Узнаёте себя?"
- `dianomi:solutions` — карточки решений
- `dianomi:before-after` — блок до/после
- `dianomi:approach` — шаги "Наш подход"
- `dianomi:about-company` — о компании
- `dianomi:faq` — FAQ-аккордеон
- `dianomi:cta-form` — CTA с формой

### 4. Страницы
- `index.php` — главная (использует все компоненты)
- `about.php` — о компании
- `contacts.php` — контакты
- `project.php` — форма обратной связи
- `business-systems.php` — системы управления бизнесом
- `404.php` — страница ошибки

## Инструкция по установке

### Шаг 1: Установка Bitrix
1. Установить OpenServer: https://open-server.ru/
2. Скачать Bitrix Business: https://www.1c-bitrix.ru/download/
3. Распаковать в `C:\OpenServer\domains\dianomi.local\`
4. Пройти мастер установки

### Шаг 2: Активация шаблона
1. Скопировать `/local/` в корень сайта
2. Скопировать `/css/`, `/js/`, `/img/` в корень сайта
3. Админка → Настройки → Настройки продукта → Шаблоны сайта
4. Выбрать шаблон "dianomi"

### Шаг 3: Создание инфоблоков
1. Открыть в браузере: `http://dianomi.local/local/php/install_iblocks.php`
2. Скрипт создаст все необходимые инфоблоки
3. **Удалить файл `install_iblocks.php` после использования!**

### Шаг 4: Заполнение инфоблоков
Через Админку → Контент → Информационные блоки:

**page_hero** (Hero-блоки):
- Создать элемент с кодом `index`
- Заполнить поля: BADGE_TEXT, TITLE, DESCRIPTION, COUNTER_1-3, COUNTER_LABEL_1-3, BENEFITS_LIST

**page_problems** (Проблемы):
- Создать 6 элементов (по одному на каждую проблему)
- Заполнить: ICON, TITLE, DESCRIPTION, ORDER

**page_solutions** (Решения):
- Создать 3 элемента
- Заполнить: ICON, TITLE, DESCRIPTION, BENEFITS, LINK_TEXT, LINK_URL, BORDER_COLOR

**page_before_after** (До/После):
- Создать 1 элемент
- Заполнить: BEFORE_TITLE, AFTER_TITLE, BEFORE_LIST, AFTER_LIST

**page_approach** (Подход):
- Создать 6 элементов (по одному на каждый шаг)
- Заполнить: STEP_NUMBER, TITLE, ORDER

**page_about** (О компании):
- Создать 1 элемент
- Заполнить: DESCRIPTION, OFFICE, FEATURES

**page_faq** (FAQ):
- Создать 8 элементов (по одному на каждый вопрос)
- Заполнить: QUESTION, ANSWER, ORDER

### Шаг 5: Создание меню
1. Админка → Настройки → Настройки продукта → Меню
2. Создать меню "main_menu"
3. Добавить пункты:
   - Главная → `/index.php`
   - Решения (раздел)
     - Системы управления бизнесом → `/business-systems.php`
     - Битрикс24 → `/bitrix24.php`
     - Тарифы Битрикс24 → `/bitrix24-prices.php`
     - Веб-системы → `/web-systems.php`
     - 1С-Битрикс → `/1c-bitrix.php`
     - Тарифы 1С-Битрикс → `/1c-bitrix-prices.php`
     - Данные и BI-аналитика → `/data-bi.php`
   - О компании → `/about.php`
   - Контакты → `/contacts.php`

### Шаг 6: Создание веб-формы
1. Админка → Контент → Веб-формы → Создать
2. Имя: "project_form"
3. Поля:
   - Имя (текст, required)
   - Телефон (текст, required)
   - Сообщение (textarea)
4. Настроить email-уведомления

### Шаг 7: Настройка SEO
1. Для каждой страницы в Админке:
   - Title
   - Description
   - Keywords
   - og:title, og:description, og:image
2. Админка → Настройки → Настройки продукта → SEO-элементы
3. Включить ЧПУ

### Шаг 8: Включение композита
1. Админка → Настройки → Настройки продукта → Композитный режим → Включить
2. Время жизни кеша: 3600 сек
3. Контролировать вывод: Нет

### Шаг 9: Проверка
- Открыть главную страницу
- Проверить: зелёная иконка композита, `<!-- composite -->` в исходном коде
- Проверить работу мегамею
- Проверить FAQ-аккордеон
- Проверить адаптивность

## Дальнейшие шаги

1. Создать остальные страницы (bitrix24.php, web-systems.php и т.д.) по аналогии с business-systems.php
2. Заполнить все инфоблоки контентом из HTML-файлов
3. Настроить robots.txt и sitemap.xml
4. Протестировать на всех устройствах
5. Деплой на Bitrix-хостинг

## Важные замечания

- Все пути к ресурсам использовать абсолютные: `/img/`, `/css/`, `/js/`
- Или использовать: `<?=SITE_TEMPLATE_PATH?>/img/`
- Удалять `install_iblocks.php` после использования!
- Включать кеширование для всех компонентов и страниц
