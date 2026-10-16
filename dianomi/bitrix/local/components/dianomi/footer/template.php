<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Dianomi Footer Component
 * @package bitrix\dianomi\footer
 */

$APPLICATION->IncludeRegion("dianomi.footer.region");
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
        <p class="footer__desc"><?=GetMessage("FOOTER_DESC")?></p>
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
              <span style="color:rgba(255,255,255,0.7);"><?=GetMessage("FOOTER_CITY")?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Решения -->
      <div>
        <h5 class="footer__heading"><?=GetMessage("FOOTER_SOLUTIONS")?></h5>
        <ul class="footer__list">
          <li><a href="/business-systems.php"><?=GetMessage("FOOTER_BIZ_SYS")?></a></li>
          <li><a href="/bitrix24.php"><?=GetMessage("FOOTER_B24")?></a></li>
          <li><a href="/bitrix24-prices.php"><?=GetMessage("FOOTER_B24_PRICES")?></a></li>
          <li><a href="/web-systems.php"><?=GetMessage("FOOTER_WEB_SYS")?></a></li>
          <li><a href="/1c-bitrix.php"><?=GetMessage("FOOTER_1C")?></a></li>
          <li><a href="/1c-bitrix-prices.php"><?=GetMessage("FOOTER_1C_PRICES")?></a></li>
          <li><a href="/data-bi.php"><?=GetMessage("FOOTER_DATA_BI")?></a></li>
        </ul>
      </div>

      <!-- О компании -->
      <div>
        <h5 class="footer__heading"><?=GetMessage("FOOTER_ABOUT")?></h5>
        <ul class="footer__list">
          <li><a href="/about.php"><?=GetMessage("FOOTER_ABOUT_LINK")?></a></li>
          <li><a href="/contacts.php"><?=GetMessage("FOOTER_CONTACTS")?></a></li>
        </ul>
      </div>
    </div>

    <div class="footer__copyright">
      &copy; <span id="currentYear">2026</span> dianomi. <?=GetMessage("FOOTER_RIGHTS")?>
    </div>
  </div>
</footer>
