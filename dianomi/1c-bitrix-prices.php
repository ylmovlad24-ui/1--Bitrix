<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тарифы 1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("description", "Актуальные тарифы 1С-Битрикс для интернет-магазинов и корпоративных порталов.");
$APPLICATION->SetPageProperty("og:title", "Тарифы 1С-Битрикс — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Актуальные тарифы 1С-Битрикс для интернет-магазинов и корпоративных порталов.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/1c-bitrix-prices.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/1c-bitrix-prices.php");
?>

<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Тарифы 1С-Битрикс</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Выберите подходящую редакцию для вашего бизнеса</p>
    </div>
    
    <div style="max-width:960px;margin:0 auto;">
      <p style="text-align:center;color:var(--text-light);">Здесь будут размещены актуальные тарифы 1С-Битрикс</p>
    </div>
  </div>
</section>

<?$APPLICATION->IncludeComponent("dianomi:cta-form", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
), false);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
