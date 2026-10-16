# Multi-Site Architecture - Summary

## 🎯 Что создано

### 1. Документация
- ✅ `docs/MULTISITE-ARCHITECTURE.md` - Полная документация по архитектуре
- ✅ `docs/examples/MULTISITE-SUMMARY.md` - Этот файл

### 2. Конфигурационные файлы
- ✅ `docs/examples/bitrix/php_interface/init.php` - Глобальная инициализация для всех сайтов
- ✅ `docs/examples/bitrix/php_interface/dbconn.php` - Подключение к БД (мульти-базы)
- ✅ `docs/examples/bitrix/php_interface/utilities.php` - Общие утилиты

### 3. Шаблоны сайтов
- ✅ `docs/examples/template-site/index.php` - Шаблон главной страницы
- ✅ `docs/examples/template-site/bitrix/templates/{site_name}/header.php` - Шапка
- ✅ `docs/examples/template-site/bitrix/templates/{site_name}/footer.php` - Подвал
- ✅ `docs/examples/template-site/bitrix/templates/{site_name}/.description.php` - Описание шаблона

### 4. Скрипты автоматизации
- ✅ `scripts/create-new-site.php` - Создание нового сайта
- ✅ `scripts/configure-bitrix-admin.php` - Настройка Bitrix admin

### 5. Примеры конфигураций
- ✅ `docs/examples/sites-config.php` - Конфигурация всех сайтов
- ✅ `docs/examples/setup-databases.sql` - SQL для создания БД
- ✅ `docs/examples/DEPLOYMENT-CHECKLIST.md` - Чек-лист деплоя

---

## 🚀 Быстрый старт

### Шаг 1: Создание нового сайта

```bash
cd /path/to/project

# Создать новый сайт
php scripts/create-new-site.php \
    --name=newsite \
    --domain=site.ru \
    --db-prefix=newsite \
    --title="New Site Title"
```

### Шаг 2: Настройка базы данных

```bash
# Создать базы данных
mysql -u root -p < docs/examples/setup-databases.sql

# Или вручную:
CREATE DATABASE site_ru_newsite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'site_ru_newsite'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON site_ru_newsite.* TO 'site_ru_newsite'@'localhost';
FLUSH PRIVILEGES;
```

### Шаг 3: Обновление конфигурации БД

Отредактируйте файл:
```
/newsite/bitrix/php_interface/dbconn.newsite.php
```

Замените:
- `DB_USER` → ваш пользователь
- `DB_PASSWORD` → ваш пароль
- `DB_NAME` → имя базы данных

### Шаг 4: Добавление сайта в Bitrix Admin

1. Войдите в админку Bitrix
2. Перейдите: **Настройки → Структура сайта → Список сайтов**
3. Нажмите **"Добавить сайт"**
4. Заполните:
   - **Доменное имя**: `site.ru`
   - **Код сайта**: `newsite`
   - **Папка**: `/newsite/`
   - **Имя**: `New Site Title`
   - **Шаблон**: `newsite`
   - **Сортировка**: `400`
   - **Активный**: Да

### Шаг 5: Настройка языка

Для каждого сайта добавьте языки:
- **ru** - Русский
- **en** - English (опционально)

### Шаг 6: Очистка кэша

**Настройки → Настройки продукта → Кэш** → Очистить кэш

---

## 📋 Структура проекта

```
/var/www/site.ru/
│
├── bitrix/                          # Общее ядро Bitrix
│   ├── modules/                     # Общие модули
│   ├── components/                  # Общие компоненты
│   ├── templates/                   # Общие шаблоны
│   └── php_interface/
│       ├── init.php                 # Глобальная инициализация ✅
│       ├── dbconn.php               # Подключение к БД ✅
│       └── utilities.php            # Общие утилиты ✅
│
├── dianomi/                         # Сайт 1 (существующий)
│   ├── index.php
│   ├── bitrix/
│   │   ├── templates/dianomi/       # Шаблон сайта
│   │   └── php_interface/
│   │       └── init.dianomi.php     # Инициализация сайта
│   └── bitrix/php_interface/
│       └── dbconn.dianomi.php       # БД сайта
│
├── shop/                            # Сайт 2 (новый)
│   ├── index.php                    # ✅ Создан скриптом
│   ├── bitrix/
│   │   ├── templates/shop/          # Шаблон сайта
│   │   └── php_interface/
│   │       └── init.shop.php        # ✅ Создан скриптом
│   └── bitrix/php_interface/
│       └── dbconn.shop.php          # ✅ Создан скриптом
│
└── blog/                            # Сайт 3 (новый)
    ├── index.php
    └── bitrix/
        ├── templates/blog/
        └── php_interface/
            └── init.blog.php
```

---

## 🔧 Использование утилит

### Получить код текущего сайта
```php
$siteCode = getCurrentSiteCode();
// Returns: 'dianomi', 'shop', 'blog', etc.
```

### Проверить сайт
```php
if (isSite('dianomi')) {
    // Code specific for dianomi site
}
```

### Получить путь к файлу сайта
```php
$path = getSitePath('css/style.css');
// Returns: /var/www/site.ru/dianomi/css/style.css
```

### Получить URL сайта
```php
$url = getSiteUrl('contacts.php');
// Returns: http://site.ru/dianomi/contacts.php
```

### Логирование для конкретного сайта
```php
siteLogError('Something went wrong');
// Logs to: /logs/site_dianomi_errors.log
```

---

## 🔐 Безопасность

1. **Файловые права**:
   ```bash
   # Директории
   find /var/www/site.ru -type d -exec chmod 755 {} \;
   
   # Файлы
   find /var/www/site.ru -type f -exec chmod 644 {} \;
   
   # Критичные файлы
   chmod 600 /var/www/site.ru/*/bitrix/php_interface/dbconn*.php
   ```

2. **Сильные пароли** для каждой БД

3. **Изоляция сайтов** - каждый сайт в своей папке

4. **Регулярные бэкапы**:
   - Ядро Bitrix: 1 раз в неделю
   - Файлы сайтов: ежедневно
   - Базы данных: ежедневно

---

## 📊 Мониторинг

### Логи ошибок по сайтам
```bash
# Dianomi
tail -f /var/www/site.ru/logs/site_dianomi_errors.log

# Shop
tail -f /var/www/site.ru/logs/site_shop_errors.log
```

### Проверка состояния сайтов
```bash
curl -I http://site.ru/dianomi/
curl -I http://site.ru/shop/
curl -I http://site.ru/blog/
```

---

## 🔄 Обновления

### Обновление ядра Bitrix
1. Сделать бэкап
2. Обновить файлы в `/bitrix/`
3. Протестировать каждый сайт
4. Если всё ОК - деплой в прод

### Обновление конкретного сайта
1. Изменения только в папке сайта
2. Не затрагивает другие сайты
3. Безопасный деплой

---

## 🆘 Решение проблем

### Сайт не загружается
```bash
# Проверить папку
ls -la /var/www/site.ru/{site_name}/

# Проверить index.php
cat /var/www/site.ru/{site_name}/index.php

# Проверить права
chmod 755 /var/www/site.ru/{site_name}/
chmod 644 /var/www/site.ru/{site_name}/index.php
```

### Ошибка подключения к БД
```bash
# Проверить файл dbconn
cat /var/www/site.ru/{site_name}/bitrix/php_interface/dbconn.{site_name}.php

# Проверить соединение
mysql -u {db_user} -p -h localhost {db_name}
```

### Шаблоны не отображаются
```bash
# Проверить шаблон
ls -la /var/www/site.ru/bitrix/templates/{site_name}/

# Очистить кэш в админке Bitrix
```

---

## 📚 Дополнительная документация

- [Bitrix Multi-Site Official Docs](https://www.1c-bitrix.ru/documentation/)
- [MULTISITE-ARCHITECTURE.md](MULTISITE-ARCHITECTURE.md) - Полная архитектура
- [DEPLOYMENT-CHECKLIST.md](docs/examples/DEPLOYMENT-CHECKLIST.md) - Чек-лист деплоя

---

**Версия:** 1.0  
**Дата:** 2025  
**Автор:** Development Team
