<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты — Dianomi");
$APPLICATION->SetPageProperty("description", "Свяжитесь с нами: телефон, email, адрес в Барнауле.");
$APPLICATION->SetPageProperty("og:title", "Контакты — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Свяжитесь с нами: телефон, email, адрес в Барнауле.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/contacts.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/contacts.php");
?>

<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Контакты</h2>
    </div>
    
    <div style="max-width:720px;margin:0 auto;">
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:32px;margin-bottom:48px;">
        <div style="text-align:center;">
          <div style="font-size:2rem;margin-bottom:12px;">📞</div>
          <h3 style="font-size:1.125rem;font-weight:600;margin-bottom:8px;">Телефон</h3>
          <a href="tel:+738520000000" style="color:var(--primary);">+7 (3852) 000-00-00</a>
        </div>
        <div style="text-align:center;">
          <div style="font-size:2rem;margin-bottom:12px;">✉️</div>
          <h3 style="font-size:1.125rem;font-weight:600;margin-bottom:8px;">Email</h3>
          <a href="mailto:info@dianomi.ru" style="color:var(--primary);">info@dianomi.ru</a>
        </div>
        <div style="text-align:center;">
          <div style="font-size:2rem;margin-bottom:12px;">📍</div>
          <h3 style="font-size:1.125rem;font-weight:600;margin-bottom:8px;">Адрес</h3>
          <p style="color:var(--text-light);">г. Барнаул</p>
        </div>
      </div>

      <div style="text-align:center;">
        <h3 style="font-size:1.25rem;font-weight:600;margin-bottom:16px;">Или напишите нам</h3>
        <a href="https://t.me/dianomi" class="btn btn-accent" target="_blank" rel="noopener">Telegram: @dianomi</a>
      </div>
    </div>
  </div>
</section>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
