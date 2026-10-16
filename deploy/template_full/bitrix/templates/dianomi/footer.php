<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<footer class="footer">
  <div class="container">
    <div class="footer__inner">
      <!-- Brand -->
      <div class="footer__brand">
        <div class="footer__logo">
          <img src="<?=SITE_TEMPLATE_PATH?>/img/logo-dianomi.svg" alt="dianomi" width="32" height="32">
          dianomi
        </div>
        <p class="footer__desc"><?=GetMessage("FOOTER_BRAND_DESC")?></p>
        <div class="contact-block" style="margin-top:20px;">
          <div class="contact-block__item">
            <div class="contact-block__icon">&#128222;</div>
            <div class="contact-block__text">
              <a href="tel:+738520000000" style="color:rgba(255,255,255,0.9);"><?=GetMessage("FOOTER_PHONE")?></a>
            </div>
          </div>
          <div class="contact-block__item">
            <div class="contact-block__icon">&#9993;&#65039;</div>
            <div class="contact-block__text">
              <a href="mailto:info@dianomi.ru" style="color:rgba(255,255,255,0.9);"><?=GetMessage("FOOTER_EMAIL")?></a>
            </div>
          </div>
          <div class="contact-block__item">
            <div class="contact-block__icon">&#128205;</div>
            <div class="contact-block__text">
              <span style="color:rgba(255,255,255,0.7);"><?=GetMessage("FOOTER_ADDRESS")?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Решения -->
      <div>
        <h5 class="footer__heading"><?=GetMessage("FOOTER_NAV_SOLUTIONS")?></h5>
        <ul class="footer__list">
          <li><a href="<?=SITE_DIR?>business-systems.php">Системы управления бизнесом</a></li>
          <li><a href="<?=SITE_DIR?>bitrix24.php">Битрикс24</a></li>
          <li><a href="<?=SITE_DIR?>bitrix24-prices.php">Тарифы Битрикс24</a></li>
          <li><a href="<?=SITE_DIR?>web-systems.php">Веб-системы</a></li>
          <li><a href="<?=SITE_DIR?>1c-bitrix.php">1С-Битрикс</a></li>
          <li><a href="<?=SITE_DIR?>1c-bitrix-prices.php">Тарифы 1С-Битрикс</a></li>
          <li><a href="<?=SITE_DIR?>data-bi.php">Данные и BI-аналитика</a></li>
        </ul>
      </div>

      <!-- О компании -->
      <div>
        <h5 class="footer__heading"><?=GetMessage("FOOTER_NAV_ABOUT")?></h5>
        <ul class="footer__list">
          <li><a href="<?=SITE_DIR?>about.php">О компании</a></li>
          <li><a href="<?=SITE_DIR?>contacts.php">Контакты</a></li>
        </ul>
      </div>
    </div>

    <div class="footer__copyright">
      &copy; <?=date('Y')?> <?=GetMessage("FOOTER_COPYRIGHT")?>
    </div>
  </div>
</footer>

<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
</body>
</html>
