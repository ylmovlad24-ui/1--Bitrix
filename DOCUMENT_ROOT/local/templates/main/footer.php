<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Dianomi site template footer
 */
?>

<footer class="footer">
	<div class="container">
		<div class="footer__inner">
			<!-- Brand -->
			<div class="footer__brand">
				<div class="footer__logo">
					<img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-dianomi.svg" alt="dianomi" width="32" height="32">
					dianomi
				</div>
				<p class="footer__desc">Проектируем и внедряем связанные цифровые системы для управления компанией и работы с клиентами.</p>
				<div class="contact-block" style="margin-top:20px;">
					<div class="contact-block__item">
						<div class="contact-block__icon">📞</div>
						<div class="contact-block__text">
							<a href="tel:+738520000000" style="color:rgba(255,255,255,0.9);">+7 (3852) 000-00-00</a>
						</div>
					</div>
					<div class="contact-block__item">
						<div class="contact-block__icon">✉️</div>
						<div class="contact-block__text">
							<a href="mailto:info@dianomi.ru" style="color:rgba(255,255,255,0.9);">info@dianomi.ru</a>
						</div>
					</div>
					<div class="contact-block__item">
						<div class="contact-block__icon">📍</div>
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
					<li><a href="/business-systems/">Системы управления бизнесом</a></li>
					<li><a href="/web-systems/">Веб-системы</a></li>
					<li><a href="/integrations/">Интеграции</a></li>
					<li><a href="/data-bi/">Данные и BI-аналитика</a></li>
					<li><a href="/ai-bots/">ИИ и чат-боты</a></li>
				</ul>
			</div>

			<!-- Платформы -->
			<div>
				<h5 class="footer__heading">Платформы</h5>
				<ul class="footer__list">
					<li><a href="/bitrix24/">Битрикс24</a></li>
					<li><a href="/bitrix24/">Облачный Битрикс24</a></li>
					<li><a href="/bitrix24-on-premise/">Коробочный Битрикс24</a></li>
					<li><a href="/bitrix24-prices/">Тарифы Битрикс24</a></li>
					<li><a href="/1c-bitrix/">1С-Битрикс</a></li>
					<li><a href="/1c-bitrix-prices/">Тарифы 1С-Битрикс</a></li>
				</ul>
			</div>

			<!-- Интеграции -->
			<div>
				<h5 class="footer__heading">Интеграции</h5>
				<ul class="footer__list">
					<li><a href="/integrations/#bx1c">Битрикс24 и 1С</a></li>
					<li><a href="/integrations/#site1c">Сайт и 1С</a></li>
					<li><a href="/integrations/#sitebx">Сайт и Битрикс24</a></li>
					<li><a href="/integrations/#api">API-интеграции</a></li>
				</ul>
			</div>

			<!-- Dianomi -->
			<div>
				<h5 class="footer__heading">Dianomi</h5>
				<ul class="footer__list">
					<li><a href="/cases/">Кейсы</a></li>
					<li><a href="/approach/">Как работаем</a></li>
					<li><a href="/about/">О компании</a></li>
					<li><a href="/contacts/">Контакты</a></li>
					<li><a href="/project/">Обсудить проект</a></li>
				</ul>
			</div>

			<!-- Документы -->
			<div>
				<h5 class="footer__heading">Документы</h5>
				<ul class="footer__list">
					<li><a href="/privacy/">Политика конфиденциальности</a></li>
					<li><a href="/personal-data/">Согласие на обработку данных</a></li>
					<li><a href="/license/">Реквизиты</a></li>
				</ul>
			</div>
		</div>

		<div class="footer__copyright">
			© <span id="currentYear">2026</span> dianomi. Все права защищены.
		</div>
	</div>
</footer>

</body>
</html>
