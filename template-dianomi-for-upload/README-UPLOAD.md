# 📤 Инструкция по загрузке шаблона dianomi на Hostiman

## 📁 Папка для загрузки

**Путь:**
```
C:\Users\Vlad\Documents\Ptodjec\1--Bitrix\template-dianomi-for-upload\
```

## 📋 Структура шаблона

```
template-dianomi-for-upload/
├── .description.php       ← описание шаблона
├── .style.php            ← стили шаблона
├── header.php            ← шапка сайта (с панелью админки)
├── footer.php            ← подвал сайта
├── css/
│   └── style.css         ← стили сайта (с z-index для админки)
├── js/
│   └── main.js           ← JavaScript (меню, бургер)
├── img/
│   └── logo-dianomi.svg  ← логотип
├── components/
│   └── bitrix/
│       └── menu/
│           ├── templates/
│           │   ├── megamenu/    ← mega-menu
│           │   └── mobile/      ← мобильное меню
└── lang/
    └── ru/
        ├── description.php
        ├── header.php
        └── footer.php
```

## 🚀 Как загрузить на сервер

### Способ 1: Через файловый менеджер Hostiman (рекомендуется)

1. **Запаковать папку в ZIP:**
   - Откройте папку `template-dianomi-for-upload\`
   - Нажмите правой кнопкой мыши на папку
   - Выберите **"Отправить"** → **"Сжатая ZIP-папка"**
   - Получится файл: `template-dianomi-for-upload.zip`

2. **Зайти в файловый менеджер Hostiman:**
   - Войдите в панель Hostiman.ru
   - Перейдите в "Файловый менеджер"
   - Перейдите в папку: `/www/site.ru/bitrix/templates/`

3. **Загрузить ZIP:**
   - Нажмите **"Загрузить файлы"** (или "Upload")
   - Выберите `template-dianomi-for-upload.zip`
   - Дождитесь загрузки

4. **Распаковать:**
   - Найдите `template-dianomi-for-upload.zip` в файловом менеджере
   - Нажмите правой кнопкой → **"Распаковать"** (или "Extract")
   - Убедитесь, что создалась папка `dianomi/`

5. **Переименовать (если нужно):**
   - Если распаковалось как `template-dianomi-for-upload/`
   - Переименуйте в `dianomi/`

### Способ 2: Через FTP (FileZilla)

1. **Подключиться к серверу:**
   - Хост: ваш домен или IP
   - Логин: ваш FTP логин
   - Пароль: ваш FTP пароль
   - Порт: 21

2. **Перейти в папку:**
   - Сервер: `/www/site.ru/bitrix/templates/`

3. **Загрузить папку:**
   - Перетащить папку `template-dianomi-for-upload/`
   - Или запаковать в ZIP и загрузить, затем распаковать

## ✅ Проверка после загрузки

Зайдите в файловый менеджер и проверьте, что есть:

```
/www/site.ru/bitrix/templates/dianomi/
├── .description.php       ← ОБЯЗАТЕЛЬНО!
├── header.php             ← ОБЯЗАТЕЛЬНО!
├── footer.php             ← ОБЯЗАТЕЛЬНО!
├── css/style.css
├── js/main.js
└── img/logo-dianomi.svg
```

## 🎯 Настройка в админке Bitrix

1. Войти в админку: `site.ru/bitrix/admin/`
2. **Настройки → Настройки продукта → Сайты → Шаблоны сайтов**
3. Найти шаблон "Dianomi"
4. Если не появился - очистить кэш: **Настройки → Настройки продукта → Кэш → Очистить кэш**
5. Применить шаблон к сайту: **Настройки → Настройки продукта → Сайты → Список сайтов**
6. Выбрать шаблон "Dianomi"

## 🔧 Что уже настроено

- ✅ Панель админки (`ShowPanel()`)
- ✅ z-index для панели админки (10000)
- ✅ Меню с mega-menu
- ✅ Мобильное меню (бургер)
- ✅ SEO meta-теги
- ✅ OpenGraph теги
- ✅ Подключение шрифтов Google Fonts
- ✅ Адаптивный дизайн

## 📚 Документация

Все остальные файлы проекта переведены в документацию:
- `docs/MULTISITE-DIFFERENT-DOMAINS.md` - архитектура multi-site
- `docs/QUICK-START-MULTI-SITE.md` - быстрый старт
- `framework-docs-main/` - официальная документация Bitrix

---

**Готово к загрузке!** 🎉
