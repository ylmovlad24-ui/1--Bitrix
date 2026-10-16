<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Dianomi — Реквизиты компании");
$APPLICATION->SetPageProperty("description", "Реквизиты компании Dianomi — авторизованный партнёр 1С-Битрикс.");
$APPLICATION->SetPageProperty("og:title", "Dianomi — Реквизиты");
$APPLICATION->SetPageProperty("og:description", "Реквизиты компании Dianomi.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/license.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/license.php");
?>

<section class="section">
  <div class="container" style="max-width:800px;">
    <h1>Реквизиты компании</h1>
    
    <div style="margin-top:24px; line-height:1.8;">
      <h2>Реквизиты Dianomi</h2>
      <table style="width:100%; border-collapse:collapse; margin-top:16px;">
        <tr>
          <td style="padding:8px 0; font-weight:bold;">Наименование:</td>
          <td style="padding:8px 0;">ООО «Дианомі»</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">ИНН:</td>
          <td style="padding:8px 0;">0000000000</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">КПП:</td>
          <td style="padding:8px 0;">000000000</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">ОГРН:</td>
          <td style="padding:8px 0;">0000000000000</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">Юридический адрес:</td>
          <td style="padding:8px 0;">г. Барнаул, ул. Примерная, д. 1</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">Расчётный счёт:</td>
          <td style="padding:8px 0;">00000000000000000000</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">Банк:</td>
          <td style="padding:8px 0;">Примерный Банк</td>
        </tr>
        <tr>
          <td style="padding:8px 0; font-weight:bold;">БИК:</td>
          <td style="padding:8px 0;">000000000</td>
        </tr>
      </table>
      
      <p style="margin-top:24px; color:var(--text-muted); font-size:0.875rem;">
        ⚠️ Данные являются заглушками. Замените их на реальные реквизиты перед публикацией.
      </p>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
