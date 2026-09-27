<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<footer class="footer">
  <div class="container">
    <div class="footer__inner">
      <div class="footer__brand">
        <div class="footer__logo">
          <img src="<?=SITE_TEMPLATE_PATH?>/img/logo-dianomi.svg" alt="dianomi" width="32" height="32">
          dianomi
        </div>
        <p class="footer__desc">Проектируем и внедряем связанные цифровые системы для управления компанией и работы с клиентами.</p>
        <div class="contact-block" style="margin-top:20px;">
          <div class="contact-block__item">
            <div class="contact-block__icon">📞</div>
            <div class="contact-block__text"><a href="tel:+738520000000" style="color:rgba(255,255,255,0.9);">+7 (3852) 000-00-00</a></div>
          </div>
          <div class="contact-block__item">
            <div class="contact-block__icon">✉️</div>
            <div class="contact-block__text"><a href="mailto:info@dianomi.ru" style="color:rgba(255,255,255,0.9);">info@dianomi.ru</a></div>
          </div>
          <div class="contact-block__item">
            <div class="contact-block__icon">📍</div>
            <div class="contact-block__text"><span style="color:rgba(255,255,255,0.7);">г. Барнаул</span></div>
          </div>
        </div>
      </div>
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
      <div>
        <h5 class="footer__heading">Dianomi</h5>
        <ul class="footer__list">
          <li><a href="/about.php">О компании</a></li>
          <li><a href="/contacts.php">Контакты</a></li>
        </ul>
      </div>
    </div>
    <div class="footer__copyright">
      © <span id="currentYear">2026</span> dianomi. Все права защищены.
    </div>
  </div>
</footer>
<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
