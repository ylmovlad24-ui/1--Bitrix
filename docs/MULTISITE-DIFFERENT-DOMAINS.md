# ✅ Multi-Site Architecture - Разные домены

## 📌 Режим: Многосайтовость на разных доменах

Согласно [официальной документации Bitrix](https://dev.1c-bitrix.ru), когда сайты работают на **разных доменах**, каждый сайт имеет:
- Свою собственную папку на сервере
- Символические ссылки на общие ресурсы (`bitrix/`, `upload/`, `local/`)
- Общее ядро Bitrix
- Общую базу данных

---

## 🏗️ Правильная структура

```
/var/www/
├── shared/                          ← ОБЩИЕ файлы для всех сайтов
│   ├── bitrix/                      ← ОДНО ядро Bitrix
│   │   ├── modules/
│   │   ├── components/
│   │   ├── templates/
│   │   │   ├── dianomi/             ← шаблон для dianomi.ru
│   │   │   ├── shop/                ← шаблон для shop.ru
│   │   │   └── blog/                ← шаблон для blog.ru
│   │   └── php_interface/
│   │       ├── init.php             ← общий код
│   │       └── dbconn.php           ← общая БД
│   ├── upload/                      ← общие загрузки
│   └── local/                       ← общие файлы
│
├── site-dianomi/                    ← сайт 1 (dianomi.ru)
│   ├── bitrix → /var/www/shared/bitrix       ← символическая ссылка!
│   ├── upload → /var/www/shared/upload       ← символическая ссылка!
│   ├── local → /var/www/shared/local         ← символическая ссылка!
│   ├── index.php
│   ├── about.php
│   ├── contacts.php
│   ├── .htaccess
│   └── 404.php
│
├── site-shop/                       ← сайт 2 (shop.ru)
│   ├── bitrix → /var/www/shared/bitrix       ← символическая ссылка!
│   ├── upload → /var/www/shared/upload       ← символическая ссылка!
│   ├── local → /var/www/shared/local         ← символическая ссылка!
│   ├── index.php
│   ├── catalog.php
│   ├── .htaccess
│   └── 404.php
│
└── site-blog/                       ← сайт 3 (blog.ru)
    ├── bitrix → /var/www/shared/bitrix       ← символическая ссылка!
    ├── upload → /var/www/shared/upload       ← символическая ссылка!
    ├── local → /var/www/shared/local         ← символическая ссылка!
    ├── index.php
    └── .htaccess
```

---

## 🔑 Ключевые принципы

### ✅ ЧТО ОБЩЕЕ:
- **Ядро Bitrix** (`bitrix/`) - одна установка
- **База данных** - одна на все сайты
- **Загрузки** (`upload/`) - общие файлы
- **Модули** (`bitrix/modules/`) - общие модули

### ✅ ЧТО ОТДЕЛЬНОЕ:
- **Папка сайта** - своя для каждого домена
- **Шаблоны** (`bitrix/templates/`) - свои для каждого сайта
- **Файлы страниц** (`index.php`, `about.php`) - свои
- **VirtualHost** - свой для каждого домена
- **SSL сертификат** - свой для каждого домена

### ❌ ЧЕГО НЕЛЬЗЯ:
- Копировать папки `bitrix/`, `upload/`, `local/` между сайтами
- Создавать отдельные установки Bitrix на одной лицензии
- Использовать разные базы данных для одной установки

---

## ⚙️ Настройка сервера

### 1. Создание общей папки

```bash
# Создать общую папку для ядра
sudo mkdir -p /var/www/shared

# Установить правильные права
sudo chown -R www-data:www-data /var/www/shared
sudo chmod -R 755 /var/www/shared
```

### 2. Установка Bitrix на первый сайт

```bash
# Создать папку для первого сайта
sudo mkdir -p /var/www/site-dianomi

# Установить Bitrix в /var/www/site-dianomi/
# (через веб-установщик или консоль)

# После установки переместить общие папки
sudo mv /var/www/site-dianomi/bitrix /var/www/shared/
sudo mv /var/www/site-dianomi/upload /var/www/shared/
sudo mv /var/www/site-dianomi/local /var/www/shared/

# Создать символические ссылки
sudo ln -s /var/www/shared/bitrix /var/www/site-dianomi/bitrix
sudo ln -s /var/www/shared/upload /var/www/site-dianomi/upload
sudo ln -s /var/www/shared/local /var/www/site-dianomi/local
```

### 3. Добавление второго сайта

```bash
# Создать папку для второго сайта
sudo mkdir -p /var/www/site-shop

# Создать символические ссылки
sudo ln -s /var/www/shared/bitrix /var/www/site-shop/bitrix
sudo ln -s /var/www/shared/upload /var/www/site-shop/upload
sudo ln -s /var/www/shared/local /var/www/site-shop/local

# Скопировать файлы сайта
cp -r /path/to/shop/files/* /var/www/site-shop/

# Создать .htaccess и 404.php (если нет)
cp /var/www/site-dianomi/.htaccess /var/www/site-shop/
cp /var/www/site-dianomi/404.php /var/www/site-shop/
```

### 4. Настройка Apache

Добавить в `/etc/apache2/sites-available/bx-pool.conf`:

```apache
<VirtualHost *:80>
    DocumentRoot "/var/www/site-dianomi"
    ServerName dianomi.ru
    ServerAlias www.dianomi.ru
    
    <Directory "/var/www/site-dianomi">
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/dianomi_error.log
    CustomLog ${APACHE_LOG_DIR}/dianomi_access.log combined
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "/var/www/site-shop"
    ServerName shop.ru
    ServerAlias www.shop.ru
    
    <Directory "/var/www/site-shop">
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/shop_error.log
    CustomLog ${APACHE_LOG_DIR}/shop_access.log combined
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "/var/www/site-blog"
    ServerName blog.ru
    ServerAlias www.blog.ru
    
    <Directory "/var/www/site-blog">
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/blog_error.log
    CustomLog ${APACHE_LOG_DIR}/blog_access.log combined
</VirtualHost>
```

### 5. Включение сайта и перезапуск Apache

```bash
# Включить сайт
sudo a2ensite bx-pool.conf

# Проверить конфигурацию
sudo apache2ctl configtest

# Перезапустить Apache
sudo systemctl restart apache2
```

---

## 🎯 Настройка в Bitrix Admin

### Сайт 1 (dianomi.ru):

1. Перейти: **Настройки → Настройки продукта → Сайты → Список сайтов**
2. Редактировать основной сайт:

| Поле | Значение |
|------|----------|
| **ID** | `s1` |
| **Название** | Dianomi Site |
| **Доменное имя** | `dianomi.ru` |
| **Папка сайта** | `/` |
| **Путь к корневой папке** | `/var/www/site-dianomi/` |
| **URL сервера** | `dianomi.ru` |
| **Шаблон** | `dianomi` |
| **Сортировка** | `100` |

### Сайт 2 (shop.ru):

1. Нажать **"Добавить сайт"**
2. Заполнить:

| Поле | Значение |
|------|----------|
| **ID** | `s2` |
| **Название** | Shop Site |
| **Доменное имя** | `shop.ru` |
| **Папка сайта** | `/` |
| **Путь к корневой папке** | `/var/www/site-shop/` |
| **URL сервера** | `shop.ru` |
| **Шаблон** | `shop` |
| **Сортировка** | `200` |

### Сайт 3 (blog.ru):

| Поле | Значение |
|------|----------|
| **ID** | `s3` |
| **Название** | Blog Site |
| **Доменное имя** | `blog.ru` |
| **Папка сайта** | `/` |
| **Путь к корневой папке** | `/var/www/site-blog/` |
| **URL сервера** | `blog.ru` |
| **Шаблон** | `blog` |
| **Сортировка** | `300` |

---

## 🔒 SSL/HTTPS настройка

### Вариант 1: Отдельные SSL сертификаты

```apache
<VirtualHost *:443>
    DocumentRoot "/var/www/site-dianomi"
    ServerName dianomi.ru
    
    SSLEngine On
    SSLCertificateFile /etc/ssl/certs/dianomi.crt
    SSLCertificateKeyFile /etc/ssl/private/dianomi.key
    SSLCertificateChainFile /etc/ssl/certs/chain.crt
    
    <Directory "/var/www/site-dianomi">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Вариант 2: Wildcard сертификат (*.ru)

```apache
<VirtualHost *:443>
    DocumentRoot "/var/www/site-dianomi"
    ServerName dianomi.ru
    ServerAlias *.dianomi.ru
    
    SSLEngine On
    SSLCertificateFile /etc/ssl/certs/wildcard.crt
    SSLCertificateKeyFile /etc/ssl/private/wildcard.key
</VirtualHost>
```

### Принудительный HTTPS

Добавить в `.htaccess` каждого сайта:

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
```

---

## 📝 Файлы для каждого сайта

### `.htaccess`

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirect to Bitrix
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
</IfModule>

# Security headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-XSS-Protection "1; mode=block"
    Header set Strict-Transport-Security "max-age=31536000; includeSubDomains"
</IfModule>

# Caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### `404.php`

```php
<?php
define("STOP_STATISTICS", true);
define("NO_AGENT_STATISTICS", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("description", "Запрашиваемая страница не существует");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>404 - Страница не найдена</title>
</head>
<body>
    <h1>Страница не найдена</h1>
    <p>Запрашиваемая страница не существует или была перемещена.</p>
    <a href="/">Вернуться на главную</a>
</body>
</html>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog.php"); ?>
```

### `.access.php` (если используется)

```php
<?php
$PERM["/"]["*"] = "R";
?>
```

---

## 🗄️ База данных

**ОДНА база данных для всех сайтов:**

```sql
-- Создать одну БД
CREATE DATABASE site_ru_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Создать пользователя
CREATE USER 'site_ru_user'@'localhost' 
IDENTIFIED BY 'secure_password';

-- Дать права
GRANT ALL PRIVILEGES ON site_ru_db.* 
TO 'site_ru_user'@'localhost';

FLUSH PRIVILEGES;
```

### Настройка `dbconn.php`

Расположение: `/var/www/shared/bitrix/php_interface/dbconn.php`

```php
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Общая база данных для всех сайтов
define("DB_HOST", "localhost");
define("DB_USER", "site_ru_user");
define("DB_PASSWORD", "secure_password");
define("DB_NAME", "site_ru_db");
define("DB_TABLE_PREFIX", "b_");

global $DB;
$DB->Connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
```

---

## 🔧 Общие файлы для всех сайтов

### `bitrix/php_interface/init.php`

Расположение: `/var/www/shared/bitrix/php_interface/init.php`

```php
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Определение текущего домена
$currentDomain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

// Site-specific initialization
switch ($currentDomain) {
    case 'dianomi.ru':
    case 'www.dianomi.ru':
        define('DIANOMI_SITE', true);
        define('CURRENT_SITE_CODE', 'dianomi');
        break;
        
    case 'shop.ru':
    case 'www.shop.ru':
        define('SHOP_SITE', true);
        define('CURRENT_SITE_CODE', 'shop');
        break;
        
    case 'blog.ru':
    case 'www.blog.ru':
        define('BLOG_SITE', true);
        define('CURRENT_SITE_CODE', 'blog');
        break;
        
    default:
        define('CURRENT_SITE_CODE', 'default');
        break;
}

// Общие event handlers
AddEventHandler("main", "OnEpilog", function() {
    // Код, выполняемый для всех сайтов
});
```

---

## 📊 Разделение данных между сайтами

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

### Общие для всех сайтов:
- Пользователи (`b_user`)
- Модули (`b_module`)
- Настройки (`b_setting`)

---

## 🔐 Безопасность

### 1. Права на файлы

```bash
# Общая папка
sudo chown -R www-data:www-data /var/www/shared
sudo find /var/www/shared -type d -exec chmod 755 {} \;
sudo find /var/www/shared -type f -exec chmod 644 {} \;

# Папки сайтов
sudo chown -R www-data:www-data /var/www/site-*
sudo find /var/www/site-* -type d -exec chmod 755 {} \;
sudo find /var/www/site-* -type f -exec chmod 644 {} \;

# Критичные файлы - ограничить доступ
sudo chmod 600 /var/www/shared/bitrix/php_interface/dbconn.php
```

### 2. Настройка firewall

```bash
# Разрешить HTTP/HTTPS
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Проверить статус
sudo ufw status
```

### 3. Proactive Protection

Добавить все домены в список разрешенных:
**Настройки → Проактивная защита → Хосты/домены**

- `dianomi.ru`
- `shop.ru`
- `blog.ru`

---

## 🔄 Обновления и обслуживание

### Обновление ядра Bitrix

1. Сделать бэкап
2. Обновить файлы в `/var/www/shared/bitrix/`
3. Протестировать каждый сайт
4. Если всё ОК - деплой в прод

### Бэкап

```bash
# Бэкап базы данных
mysqldump -u site_ru_user -p site_ru_db > backup_$(date +%Y%m%d).sql

# Бэкап файлов
tar -czf shared_$(date +%Y%m%d).tar.gz /var/www/shared/
tar -czf site-dianomi_$(date +%Y%m%d).tar.gz /var/www/site-dianomi/
tar -czf site-shop_$(date +%Y%m%d).tar.gz /var/www/site-shop/
```

### Восстановление

```bash
# Восстановление БД
mysql -u site_ru_user -p site_ru_db < backup_20250101.sql

# Восстановление файлов
tar -xzf shared_20250101.tar.gz -C /
```

---

## 📈 Мониторинг

### Логи Apache

```bash
# dianomi.ru
tail -f /var/log/apache2/dianomi_error.log
tail -f /var/log/apache2/dianomi_access.log

# shop.ru
tail -f /var/log/apache2/shop_error.log
tail -f /var/log/apache2/shop_access.log

# blog.ru
tail -f /var/log/apache2/blog_error.log
tail -f /var/log/apache2/blog_access.log
```

### Проверка состояния сайтов

```bash
curl -I https://dianomi.ru
curl -I https://shop.ru
curl -I https://blog.ru
```

---

## 🆘 Решение проблем

### Сайт не открывается

```bash
# Проверить папку
ls -la /var/www/site-dianomi/

# Проверить символические ссылки
ls -la /var/www/site-dianomi/bitrix

# Проверить Apache
sudo apache2ctl configtest
sudo systemctl status apache2

# Проверить права
sudo ls -la /var/www/shared/bitrix/
```

### Ошибка "Permission denied"

```bash
# Исправить права
sudo chown -R www-data:www-data /var/www/shared
sudo chown -R www-data:www-data /var/www/site-*
sudo chmod -R 755 /var/www/shared
sudo chmod -R 755 /var/www/site-*
```

### Символические ссылки не работают

```bash
# Проверить включен ли mod_symlinks
sudo a2enmod symlink

# Проверить AllowOverride в Apache
# Должно быть: AllowOverride All
```

---

## 📚 Источники

- [Bitrix Multi-Site Documentation](https://dev.1c-bitrix.ru)
- Framework docs: `framework-docs-main/pages/advanced/multisite.md`

---

**Версия:** 1.0  
**Дата:** 2025  
**Соответствует:** Официальной документации Bitrix Framework
