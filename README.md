<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<footer class="footer">
  <div class="container">
    <div class="footer__inner">
      <!-- Brand -->
      <div class="footer__brand">
        <div class="footer__logo">
          <img src="/bitrix/templates/dianomi/img/logo-dianomi.svg" alt="dianomi" width="32" height="32">
          dianomi
        </div>
        <p class="footer__desc">Проектируем и внедряем связанные цифровые системы для управления компанией и работы с клиентами.</p>
        <div class="contact-block" style="margin-top:20px;">
          <div class="contact-block__item">
            <div class="contact-block__icon">&#128222;</div>
            <div class="contact-block__text">
              <a href="tel:+738520000000" style="color:rgba(255,255,255,0.9);">+7 (3852) 000-00-00</a>
            </div>
          </div>
          <div class="contact-block__item">
            <div class="contact-block__icon">&#9993;&#65039;</div>
            <div class="contact-block__text">
              <a href="mailto:info@dianomi.ru" style="color:rgba(255,255,255,0.9);">info@dianomi.ru</a>
            </div>
          </div>
          <div class="contact-block__item">
            <div class="contact-block__icon">&#128205;</div>
            <div class="contact-block__text">
              <span style="color:rgba(255,255,255,0.7);">г. Барнаул</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Решения -->
      <div>
        <h5 class="footer__heading">Решения</h5>
        <ul class="footer__list">
          <li><a href="/business-systems.php">Системы управления бизнесом</a></li>
          <li><a href="/bitrix24.php">Битрикс24</a></li>
          <li><a href="/bitrix24-prices.php">Тарифы Битрикс24</a></li>
          <li><a href="/web-systems.php">Веб-системы</a></li>
          <li><a href="/1c-bitrix.php">1С-Битрикс</a></li>
          <li><a href="/1c-bitrix-prices.php">Тарифы 1С-Битрикс</a></li>
          <li><a href="/data-bi.php">Данные и BI-аналитика</a></li>
        </ul>
      </div>

      <!-- О компании -->
      <div>
        <h5 class="footer__heading">Dianomi</h5>
        <ul class="footer__list">
          <li><a href="/about.php">О компании</a></li>
          <li><a href="/contacts.php">Контакты</a></li>
        </ul>
      </div>
    </div>

    <div class="footer__copyright">
      &copy; <span id="currentYear">2026</span> dianomi. Все права защищены.
    </div>
  </div>
</footer>

<script src="/bitrix/templates/dianomi/js/main.js"></script>
</body>
</html># dianomi — Лендинг партнёра 1С-Битрикс

## О компании

**dianomi** — партнёр 1С-Битрикс. Мы помогаем бизнесу расти с помощью современных цифровых решений:

- **CRM Битрикс24** — внедрение, настройка и сопровождение CRM-системы Битрикс24.
- **1С-Битрикс: Управление сайтом** — разработка, дизайн и поддержка сайтов на базе CMS 1С-Битрикс.

---

## Структура проекта

```
├── README.md                 # Этот файл
├── index.html                # Главная страница
├── about.html                # О компании
├── services.html             # Услуги (CRM Битрикс24, 1С-Битрикс)
├── editions.html             # Редакции 1С-Битрикс с тарифами
├── css/
│   └── style.css             # Основные стили (оригинальный дизайн)
├── js/
│   └── main.js               # Интерактивность + placeholder для композитного сайта
└── partials/
    ├── header.html             # Наследуемая шапка (меню + логотип)
    └── footer.html             # Наследуемый футер (логотип 1С-Битрикс, копирайт)
```

### Компонентный подход

Сайт спроектирован таким образом, чтобы при переносе на CMS **1С-Битрикс: Управление сайтом** шаблонные элементы можно было легко заменить на Bitrix-компоненты:

| Элемент      | Текущий формат         | Задача при миграции                              |
|-------------|------------------------|--------------------------------------------------|
| Шапка        | `partials/header.html` | Заменить на `bitrix:main.include` или `bitrix:header` |
| Меню         | `partials/header.html` | Заменить на `bitrix:menu`                        |
| Футер        | `partials/footer.html` | Заменить на `bitrix:main.include`                |
| Композитный сайт | Placeholder в `main.js` | Подключить SDK композита: `BX.bitrix_composite_init()` |

Все страницы сайта используют общие `header` и `footer`, что имитирует компонентную архитектуру Битрикс.

---

## Дизайн

- **Оригинальный дизайн** — не используются стандартные шаблоны, поставляемые с 1С-Битрикс.
- Современная, чистая вёрстка с адаптивной сеткой.
- Цветовая палитра: настраивается через CSS-переменные в `css/style.css`.
- Логотип 1С-Битрикс размещается в футере согласно требованиям.

---

## Обязательные элементы (согласно ТЗ)

1. На всех страницах в футере размещается текст:  
   **«Работает на «1С-Битрикс: Управление сайтом»»**  
   со ссылкой на https://www.1c-bitrix.ru/products/cms/

2. Логотип 1С-Битрикс размещается в футере.

3. Информация о том, что dianomi — партнёр 1С-Битрикс (с логотипом партнёрства — опционально).

4. На всех страницах — наследуемая шапка с логотипом и меню.

5. Поддержка технологии композитного сайта (placeholder в JS, настройка при миграции).

---

## Редакции 1С-Битрикс: Управление сайтом

Тарифы актуальны по состоянию на август 2026 г. (источник: https://www.1c-bitrix.ru/products/cms/license.php)

| Редакция                    | Стоимость (с НДС) |
|-----------------------------|-------------------|
| Старт                       | 5 680 руб.        |
| Стандарт                    | 16 400 руб.       |
| Малый бизнес ★ (популярная) | 37 600 руб.       |
| Бизнес                      | 77 200 руб.       |
| Энтерпрайз                  | от 1 950 000 руб. |
| Энтерпрайз для Постгрес     | от 2 500 000 руб. |

> ★ «Малый бизнес» — самая популярная редакция.

---

## План миграции на 1С-Битрикс

1. **Подготовка:** Перенести статические `header.html` / `footer.html` на PHP-шаблоны `header.php` / `footer.php`.
2. **Компоненты Битрикс:** Заменить статические блоки на Bitrix-компоненты (`bitrix:menu`, `bitrix:main.include` и др.).
3. **Композитный сайт:** Подключить SDK композита и настроить фреймы.
4. **Демо-версия:** Развернуть на демо-окружении 1С-Битрикс для тестирования.
5. **Тестирование:** Проверить наследуемость элементов, корректность ссылок и отображение на всех страницах.
6. **Перенос:** Загрузить на продакшн-сервер 1С-Битрикс.

---

## Запуск (локально)

Проект является статическим и может быть открыт локально в браузере:

```bash
# Откройте index.html в браузере
open index.html
# или
xdg-open index.html
```

Либо запустите локальный сервер:

```bash
python3 -m http.server 8080
# затем откройте http://localhost:8080
```

---

## Требования к окружению

- Современный браузер (Chrome, Firefox, Safari, Edge).
- Для миграции: сервер 1С-Битрикс (PHP 7.4+, MySQL/MariaDB).

---

## Лицензия

Данный проект является демонстрационным (Demo-версия) и создан для продвижения продукта «1С-Битрикс: Управление сайтом» компанией dianomi.
