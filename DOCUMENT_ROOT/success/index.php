<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('UspeЕЎno otpravleno - Dianomi');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero" style="padding:calc(var(--header-height) + 48px) 0 48px;">
  <div class="container">
    <h1 class="page-hero__title" style="color:#FFF;">Заявка отправлена</h1>
  </div>
</section>

<!-- Success Message -->
<section class="section">
  <div class="container">
    <div class="success-message animate-on-scroll">
      <div class="success-message__icon">✓</div>
      <h2 class="success-message__title">Спасибо за обращение!</h2>
      <p class="success-message__desc">
        Мы изучим описание задачи и свяжемся с вами по указанным контактам. 
        Для сложных проектов следующим этапом может быть платное обследование и проектирование архитектуры.
      </p>
      <div style="margin-top:32px;display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
        <a href="/index.php" class="btn btn-outline">На главную</a>
        <a href="/contacts/" class="btn btn-primary">Контакты</a>
      </div>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
