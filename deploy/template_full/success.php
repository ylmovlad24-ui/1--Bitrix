<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка отправлена — Dianomi");

$APPLICATION->SetPageProperty("description", "Спасибо! Мы изучим вашу задачу и свяжемся с вами в ближайшее время.");
$APPLICATION->SetPageProperty("og:title", "Заявка отправлена — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Спасибо! Мы изучим вашу задачу и свяжемся с вами в ближайшее время.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/success.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/success.php");
?>

<main id="main-content">

<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Заявка отправлена</h1>
    <p class="page-hero__subtitle">Мы изучим описание задачи и свяжемся с вами</p>
  </div>
</section>

<section class="section">
  <div class="container" style="text-align:center;">
    <div class="success-message">
      <div class="success-message__icon">✅</div>
      <h2 class="success-message__title">Мы свяжемся с вами в ближайшее время</h2>
      <p class="success-message__desc">Изучим вашу задачу, предложим формат работы и удобное время для встречи.</p>
    </div>
    <a href="/" class="btn btn-accent" style="margin-top:32px;">На главную</a>
  </div>
</section>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
