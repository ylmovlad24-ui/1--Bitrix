# 🚀 Quick Start: Multi-Site для разных доменов

## 📋 Что нужно перед началом

1. ✅ Сервер с Ubuntu/Debian и Apache
2. ✅ PHP 7.4+ с расширениями для Bitrix
3. ✅ MySQL 5.7+
4. ✅ Домены pointed to server IP (DNS A-записи)

---

## 🎯 Шаг 1: Подготовка сервера

```bash
# Создать базовую структуру
sudo mkdir -p /var/www/shared
sudo mkdir -p /var/www/site-dianomi
sudo mkdir -p /var/www/site-shop
sudo mkdir -p /var/www/site-blog

# Установить права
sudo chown -R www-data:www-data /var/www
sudo chmod -R 755 /var/www
```

---

## 🎯 Шаг 2: Инициализация первого сайта

```bash
# Запустить скрипт инициализации
cd /path/to/project
php scripts/init-first-site.php
```

Этот скрипт создаст:
- `index.php` для dianomi.ru
- `.htaccess` с настройками сервера
- Шаблон `dianomi` в `bitrix/templates/`
- Конфигурацию Apache

---

## 🎯 Шаг 3: Установка Bitrix

1. Открыть в браузере: `http://dianomi.ru/install/`
2. Следовать инструкциям установщика
3. Использовать базу данных:
   - **Host:** `localhost`
   - **User:** `site_ru_user`
   - **Password:** `secure_password_here`
   - **Database:** `site_ru_db`
4. Завершить установку

---

## 🎯 Шаг 4: Настройка общих папок

После установки Bitrix:

```bash
# Запустить скрипт настройки
php scripts/setup-multi-domain.php
```

Этот скрипт:
- Переместит `bitrix/`, `upload/`, `local/` в `/var/www/shared/`
- Создаст символические ссылки в каждой папке сайта
- Создаст `.htaccess` и `404.php` для каждого сайта

---

## 🎯 Шаг 5: Настройка Apache

```bash
# Скопировать конфигурацию
sudo cp docs/examples/apache-vhost.conf /etc/apache2/sites-available/bx-pool.conf

# Включить сайт
sudo a2ensite bx-pool.conf

# Проверить конфигурацию
sudo apache2ctl configtest

# Перезапустить Apache
sudo systemctl restart apache2
```

---

## 🎯 Шаг 6: Настройка в Bitrix Admin

1. Войти в админку: `http://dianomi.ru/bitrix/admin/`
2. Перейти: **Настройки → Настройки продукта → Сайты → Список сайтов**
3. Настроить **dianomi.ru**:
   - Доменное имя: `dianomi.ru`
   - Папка сайта: `/`
   - Путь к корневой папке: `/var/www/site-dianomi/`
4. Добавить **shop.ru**:
   - Доменное имя: `shop.ru`
   - Папка сайта: `/`
   - Путь к корневой папке: `/var/www/site-shop/`
5. Добавить **blog.ru**:
   - Доменное имя: `blog.ru`
   - Папка сайта: `/`
   - Путь к корневой папке: `/var/www/site-blog/`

---

## 🎯 Шаг 7: Настройка базы данных

```sql
-- Подключиться к MySQL
mysql -u root -p

-- Создать базу данных
CREATE DATABASE site_ru_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Создать пользователя
CREATE USER 'site_ru_user'@'localhost' 
IDENTIFIED BY 'secure_password_here';

-- Дать права
GRANT ALL PRIVILEGES ON site_ru_db.* 
TO 'site_ru_user'@'localhost';

FLUSH PRIVILEGES;

-- Выйти
EXIT;
```

Обновить `dbconn.php`:
```bash
nano /var/www/shared/bitrix/php_interface/dbconn.php
```

Заменить:
- `DB_USER` → `site_ru_user`
- `DB_PASSWORD` → `secure_password_here`
- `DB_NAME` → `site_ru_db`

---

## 🎯 Шаг 8: Настройка SSL (опционально)

```bash
# Установить Certbot
sudo apt install certbot python3-certbot-apache

# Получить сертификат для dianomi.ru
sudo certbot --apache -d dianomi.ru -d www.dianomi.ru

# Получить сертификат для shop.ru
sudo certbot --apache -d shop.ru -d www.shop.ru

# Получить сертификат для blog.ru
sudo certbot --apache -d blog.ru -d www.blog.ru
```

---

## ✅ Проверка

```bash
# Проверить работу сайтов
curl -I http://dianomi.ru
curl -I http://shop.ru
curl -I http://blog.ru

# Проверить символические ссылки
ls -la /var/www/site-dianomi/bitrix
ls -la /var/www/site-shop/bitrix
ls -la /var/www/site-blog/bitrix

# Проверить Apache
sudo apache2ctl configtest
sudo systemctl status apache2
```

---

## 📁 Итоговая структура

```
/var/www/
├── shared/                          ← ОБЩИЕ файлы
│   ├── bitrix/                      ← Ядро Bitrix
│   ├── upload/                      ← Загрузки
│   └── local/                       ← Локальные файлы
│
├── site-dianomi/                    ← dianomi.ru
│   ├── bitrix → /var/www/shared/bitrix
│   ├── upload → /var/www/shared/upload
│   ├── local → /var/www/shared/local
│   ├── index.php
│   └── .htaccess
│
├── site-shop/                       ← shop.ru
│   ├── bitrix → /var/www/shared/bitrix
│   ├── upload → /var/www/shared/upload
│   ├── local → /var/www/shared/local
│   ├── index.php
│   └── .htaccess
│
└── site-blog/                       ← blog.ru
    ├── bitrix → /var/www/shared/bitrix
    ├── upload → /var/www/shared/upload
    ├── local → /var/www/shared/local
    ├── index.php
    └── .htaccess
```

---

## 🔧 Полезные команды

### Очистка кэша
```bash
# Через админку
# Настройки → Настройки продукта → Кэш → Очистить кэш

# Или через консоль (если есть скрипт)
php /var/www/site-dianomi/clear-cache.php
```

### Просмотр логов
```bash
# dianomi.ru
tail -f /var/log/apache2/dianomi_error.log
tail -f /var/log/apache2/dianomi_access.log

# shop.ru
tail -f /var/log/apache2/shop_error.log
tail -f /var/log/apache2/shop_access.log
```

### Бэкап
```bash
# Бэкап базы данных
mysqldump -u site_ru_user -p site_ru_db > backup_$(date +%Y%m%d).sql

# Бэкап файлов
tar -czf /backup/shared_$(date +%Y%m%d).tar.gz /var/www/shared/
tar -czf /backup/site-dianomi_$(date +%Y%m%d).tar.gz /var/www/site-dianomi/
tar -czf /backup/site-shop_$(date +%Y%m%d).tar.gz /var/www/site-shop/
tar -czf /backup/site-blog_$(date +%Y%m%d).tar.gz /var/www/site-blog/
```

---

## 🆘 Решение проблем

### Сайт не открывается
```bash
# Проверить Apache
sudo systemctl status apache2

# Проверить конфигурацию
sudo apache2ctl configtest

# Проверить права
sudo ls -la /var/www/site-dianomi/

# Перезапустить Apache
sudo systemctl restart apache2
```

### Ошибка "Permission denied"
```bash
# Исправить права
sudo chown -R www-data:www-data /var/www
sudo chmod -R 755 /var/www
```

### Символические ссылки не работают
```bash
# Проверить включен mod_symlinks
sudo a2enmod symlink

# Пересоздать ссылки
sudo rm /var/www/site-shop/bitrix
sudo ln -s /var/www/shared/bitrix /var/www/site-shop/bitrix
```

---

## 📚 Документация

- [MULTISITE-DIFFERENT-DOMAINS.md](MULTISITE-DIFFERENT-DOMAINS.md) - Полная архитектура
- [Apache VirtualHost](docs/examples/apache-vhost.conf) - Конфигурация сервера
- [dbconn.php](docs/examples/bitrix/php_interface/dbconn-multi-domain.php) - Настройка БД

---

**Версия:** 1.0  
**Дата:** 2025
