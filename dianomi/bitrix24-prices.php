<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тарифы Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("description", "Актуальные тарифы Битрикс24 для облачного и коробочного решения.");
$APPLICATION->SetPageProperty("og:title", "Тарифы Битрикс24 — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Актуальные тарифы Битрикс24 для облачного и коробочного решения.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/bitrix24-prices.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/bitrix24-prices.php");
?>

<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Тарифы Битрикс24</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Выберите подходящий тариф для вашего бизнеса</p>
    </div>
    
    <div style="max-width:960px;margin:0 auto;">
      <p style="text-align:center;color:var(--text-light);">Здесь будут размещены актуальные тарифы Битрикс24</p>
    </div>
  </div>
</section>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
