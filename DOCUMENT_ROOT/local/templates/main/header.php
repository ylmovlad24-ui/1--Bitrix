<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Dianomi site template header
 * CSS/JS подключаются через Asset API с SITE_TEMPLATE_PATH
 */

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . '/css/style.css');

$asset->addString('<link rel="preconnect" href="https://fonts.googleapis.com">');
$asset->addString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>');
$asset->addString('<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">');

$asset->addJs(SITE_TEMPLATE_PATH . '/js/main.js');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $APPLICATION->ShowHead(); ?>
	<title><?php $APPLICATION->ShowTitle(); ?></title>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>

<a href="#main-content" class="sr-only" style="position:absolute;top:0;left:0;z-index:10000;padding:1rem;background:var(--primary);color:#fff;">Перейти к основному содержанию</a>

<!-- Header -->
<header class="header" id="header">
	<div class="container header__inner">
		<a href="/index.php" class="header__logo">
			<img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-dianomi.svg" alt="dianomi" width="36" height="36">
			<span>dianomi</span>
		</a>

		<nav class="header__nav" aria-label="Основная навигация">
			<ul class="header__nav-list">
				<li><a href="/index.php" class="header__nav-link">Главная</a></li>

				<!-- Решения -->
				<li class="nav-dropdown">
					<a href="/business-systems/" class="header__nav-link">Решения ▾</a>
					<div class="mega-menu">
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Управление</h4>
							<ul class="mega-menu__list">
								<li><a href="/business-systems/">Системы управления</a></li>
								<li><a href="/business-systems/#solutions">CRM и продажи</a></li>
								<li><a href="/business-systems/#solutions">Бизнес-процессы</a></li>
								<li><a href="/business-systems/#solutions">Задачи и проекты</a></li>
								<li><a href="/business-systems/#solutions">Работа с клиентами</a></li>
							</ul>
						</div>
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Веб-системы</h4>
							<ul class="mega-menu__list">
								<li><a href="/web-systems/">Корпоративные сайты</a></li>
								<li><a href="/web-systems/#types">Интернет-магазины</a></li>
								<li><a href="/web-systems/#types">B2B-порталы</a></li>
								<li><a href="/web-systems/#types">Личные кабинеты</a></li>
							</ul>
						</div>
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Данные и автоматизация</h4>
							<ul class="mega-menu__list">
								<li><a href="/data-bi/">Данные и BI-аналитика</a></li>
								<li><a href="/ai-bots/">ИИ и чат-боты</a></li>
							</ul>
						</div>
					</div>
				</li>

				<!-- 1С-Битрикс -->
				<li class="nav-dropdown">
					<a href="/1c-bitrix/" class="header__nav-link">1С-Битрикс ▾</a>
					<div class="mega-menu">
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Платформа</h4>
							<ul class="mega-menu__list">
								<li><a href="/1c-bitrix/">Веб-системы</a></li>
								<li><a href="/1c-bitrix-prices/">Тарифы</a></li>
							</ul>
						</div>
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Услуги</h4>
							<ul class="mega-menu__list">
								<li><a href="/integrations/">Интеграция с 1С</a></li>
								<li><a href="/project/">Внедрение</a></li>
								<li><a href="/project/">Сопровождение</a></li>
							</ul>
						</div>
					</div>
				</li>

				<!-- Битрикс24 -->
				<li class="nav-dropdown">
					<a href="/bitrix24/" class="header__nav-link">Битрикс24 ▾</a>
					<div class="mega-menu">
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Платформа</h4>
							<ul class="mega-menu__list">
								<li><a href="/bitrix24/">Облачный Битрикс24</a></li>
								<li><a href="/bitrix24-on-premise/">Коробочный Битрикс24</a></li>
								<li><a href="/bitrix24/#compare">Облако или коробка</a></li>
							</ul>
						</div>
						<div class="mega-menu__col">
							<h4 class="mega-menu__heading">Тарифы</h4>
							<ul class="mega-menu__list">
								<li><a href="/bitrix24-prices/">Тарифы Битрикс24</a></li>
							</ul>
						</div>
					</div>
				</li>

				<li><a href="/approach/" class="header__nav-link">Как работаем</a></li>
				<li><a href="/about/" class="header__nav-link">О Dianomi</a></li>
			</ul>
		</nav>

		<div class="header__cta">
			<a href="/project/" class="btn btn-accent btn-sm">Обсудить проект</a>
		</div>

		<button class="burger" id="burger" aria-label="Открыть меню" aria-expanded="false">
			<span class="burger__line"></span>
			<span class="burger__line"></span>
			<span class="burger__line"></span>
		</button>
	</div>
</header>

<div class="mobile-overlay" id="mobileOverlay"></div>

<nav class="mobile-menu" id="mobileMenu" aria-label="Мобильная навигация">
	<ul class="mobile-menu__list">
		<li class="mobile-menu__item"><a href="/index.php" class="mobile-menu__link">Главная</a></li>

		<li class="mobile-menu__item mobile-menu__dropdown">
			<button class="mobile-menu__dropdown-btn" aria-expanded="false">
				<span>Решения</span>
				<span class="mobile-menu__dropdown-icon">▾</span>
			</button>
			<ul class="mobile-menu__dropdown-list" style="display:none;">
				<li><a href="/business-systems/">Системы управления бизнесом</a></li>
				<li><a href="/web-systems/">Веб-системы</a></li>
				<li><a href="/data-bi/">Данные и BI-аналитика</a></li>
				<li><a href="/ai-bots/">ИИ и чат-боты</a></li>
			</ul>
		</li>

		<li class="mobile-menu__item mobile-menu__dropdown">
			<button class="mobile-menu__dropdown-btn" aria-expanded="false">
				<span>1С-Битрикс</span>
				<span class="mobile-menu__dropdown-icon">▾</span>
			</button>
			<ul class="mobile-menu__dropdown-list" style="display:none;">
				<li><a href="/1c-bitrix/">Веб-системы</a></li>
				<li><a href="/1c-bitrix-prices/">Тарифы</a></li>
				<li><a href="/project/">Внедрение</a></li>
			</ul>
		</li>

		<li class="mobile-menu__item mobile-menu__dropdown">
			<button class="mobile-menu__dropdown-btn" aria-expanded="false">
				<span>Битрикс24</span>
				<span class="mobile-menu__dropdown-icon">▾</span>
			</button>
			<ul class="mobile-menu__dropdown-list" style="display:none;">
				<li><a href="/bitrix24/">Облачный Битрикс24</a></li>
				<li><a href="/bitrix24-on-premise/">Коробочный Битрикс24</a></li>
				<li><a href="/bitrix24-prices/">Тарифы Битрикс24</a></li>
			</ul>
		</li>

		<li class="mobile-menu__item"><a href="/approach/" class="mobile-menu__link">Как работаем</a></li>
		<li class="mobile-menu__item"><a href="/about/" class="mobile-menu__link">О Dianomi</a></li>
	</ul>
	<div class="mobile-menu__cta">
		<a href="/project/" class="btn btn-accent btn-full">Обсудить проект</a>
	</div>
	<div class="mobile-menu__contacts">
		<p style="font-size:0.875rem;color:var(--text-muted);margin:12px 0 4px;">+7 (3852) 000-00-00</p>
		<p style="font-size:0.875rem;color:var(--text-muted);margin:0;">info@dianomi.ru</p>
	</div>
</nav>
