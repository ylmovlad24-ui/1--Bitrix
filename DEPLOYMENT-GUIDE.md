# Деплой сайта Dianomi на 1С-Битрикс

## 1. Подготовка сервера

### Требования
- PHP 7.4+
- MySQL 5.7+ или MariaDB 10.3+
- Apache 2.4+ или Nginx
- SSL-сертификат (HTTPS)

### Установка Bitrix
1. Скачать Bitrix Business: https://www.1c-bitrix.ru/download/
2. Распаковать на сервер
3. Пройти мастер установки через браузер

## 2. Настройка сервера

### Apache (.htaccess)
Файл `.htaccess` уже включён в проект. Убедиться, что:
- mod_rewrite включён
- mod_headers включён
- mod_expires включён (опционально)
- mod_deflate включён (опционально)

### Nginx
```nginx
server {
    listen 80;
    server_name dianomi.ru www.dianomi.ru;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name dianomi.ru www.dianomi.ru;
    
    ssl_certificate /etc/ssl/certs/dianomi.crt;
    ssl_certificate_key /etc/ssl/private/dianomi.key;
    
    root /var/www/dianomi.ru;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.ht {
        deny all;
    }
}
```

## 3. Перенос файлов

### Что переносить
- `/local/` — все кастомные файлы
- `/css/` — стили сайта
- `/js/` — JavaScript
- `/img/` — изображения
- `index.php`, `about.php`, `contacts.php` и другие .php файлы
- `.htaccess` — настройки Apache

### Что НЕ переносить
- `/bitrix/` — устанавливается на хостинге отдельно
- `/upload/` — создаётся при установке

### Команды для переноса
```bash
# Сжатие файлов
tar -czf bitrix_backup.tar.gz local/ css/ js/ img/ *.php .htaccess

# Перенос на сервер
scp bitrix_backup.tar.gz user@server:/var/www/dianomi.ru/

# Распаковка на сервере
cd /var/www/dianomi.ru/
tar -xzf bitrix_backup.tar.gz
```

## 4. Настройка базы данных

### Экспорт базы данных
```bash
# На локальном сервере
mysqldump -u root -p bitrix > bitrix_backup.sql

# Импорт на продакшен
mysql -u bitrix -p bitrix < bitrix_backup.sql
```

### Настройка подключения
Файл `/bitrix/php_interface/dbconn.php`:
```php
<?php
$dbHost = "localhost";
$dbName = "bitrix";
$dbUser = "bitrix";
$dbPassword = "password";

$DB->Connect($dbHost, $dbUser, $dbPassword);
$DB->Query("SET NAMES 'utf8'");
```

## 5. Установка модуля

### Установка через Админку
1. Войти в Админку
2. Настройки → Продукты → Модули
3. Найти "Dianomi Components"
4. Нажать "Установить"

### Установка через консоль
```bash
php /var/www/dianomi.ru/bitrix/modules/main/admin/restore.php
```

## 6. Создание инфоблоков и контента

### Вариант 1: Автоматическая установка (РЕКОМЕНДУЕТСЯ)
1. Открыть в браузере: `http://dianomi.ru/local/php/install_full_site.php`
2. Скрипт автоматически:
   - Создаст все 7 инфоблоков
   - Создаст все свойства
   - Заполнит контентом все элементы:
     - Hero для index (счётчики, преимущества)
     - 6 проблем
     - 3 решения
     - До/После
     - 6 шагов подхода
     - О компании
     - 8 FAQ вопросов
3. **Удалить файл `install_full_site.php` после использования!**

### Вариант 2: Ручное создание через Админку
1. Админка → Контент → Информационные блоки
2. Создать инфоблоки и заполнить вручную (см. инструкцию ниже)

## 7. Настройка меню

### Создание меню
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

## 8. Настройка веб-формы

### Создание формы
1. Админка → Контент → Веб-формы → Создать
2. Имя: "project_form"
3. Поля:
   - Имя (текст, required)
   - Телефон (текст, required)
   - Сообщение (textarea)
4. Настроить email-уведомления

## 9. Включение композита

### Настройка
1. Админка → Настройки → Настройки продукта → Композитный режим → Включить
2. Время жизни кеша: 3600 сек
3. Контролировать вывод: Нет

### Проверка
- Открыть главную страницу
- Проверить: зелёная иконка композита
- Проверить: `<!-- composite -->` в исходном коде
- Проверить заголовки ответа: `X-Cache: hit`

## 10. Настройка SEO

### ЧПУ
1. Админка → Настройки → Настройки продукта → SEO-элементы
2. Включить ЧПУ
3. Настроить правила переписывания URL

### Мета-теги
Для каждой страницы в Админке:
- Title
- Description
- Keywords
- og:title, og:description, og:image

### robots.txt
Файл `robots.txt` должен быть в корне сайта:
```
User-Agent: *
Disallow: /bitrix/
Disallow: /local/
Disallow: /upload/
Disallow: /auth/
Disallow: /test/

Sitemap: https://dianomi.ru/sitemap.xml
```

### sitemap.xml
Создать через Админку → Настройки → Поисковая оптимизация → Sitemap

## 11. Проверка работы

### Чек-лист
- [ ] Все 11 страниц доступны
- [ ] Мегамею работает (hover + мобильное)
- [ ] Формы отправляются
- [ ] Композит работает (зелёная иконка, `<!-- composite -->`, < 0.5s)
- [ ] Адаптивность (мобильная, планшет, десктоп)
- [ ] SEO-теги на каждой странице
- [ ] Изображения загружаются
- [ ] Внутренние ссылки работают
- [ ] 404-страница отображается
- [ ] HTTPS работает
- [ ] robots.txt доступен
- [ ] sitemap.xml доступен

## 12. Оптимизация

### Кэширование
- Включить кеширование для всех компонентов
- Время кеширования: 3600 сек

### Сжатие
- Включить gzip для CSS/JS/HTML
- Оптимизировать изображения

### CDN
- Подключить CDN для шрифтов и статических файлов
- Использовать https://fonts.googleapis.com

## 13. Мониторинг

### Логирование
- Включить логирование ошибок
- Настроить мониторинг производительности

### Бэкапы
- Настроить ежедневные бэкапы базы данных
- Настроить еженедельные бэкапы файлов

## 14. Удаление временных файлов

### Обязательно удалить
- `/local/php/install_iblocks.php` — после создания инфоблоков
- `/local/modules/dianomi/install/` — после установки модуля

## 15. Контакты для поддержки

- Email: info@dianomi.ru
- Телефон: +7 (3852) 000-00-00
- Telegram: @dianomi
