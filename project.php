<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetTitle("Обсудить проект — Dianomi");?>

<?$APPLICATION->SetPageProperty("description", "Заполните форму и мы свяжемся с вами в течение рабочего дня.");
<?$APPLICATION->SetPageProperty("og:title", "Обсудить проект — Dianomi");
<?$APPLICATION->SetPageProperty("og:description", "Заполните форму и мы свяжемся с вами в течение рабочего дня.");
<?$APPLICATION->SetPageProperty("og:type", "website");
<?$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/project.php");
<?$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
<?$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/project.php");?>

<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Обсудить проект</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Заполните форму — свяжемся в течение рабочего дня, зададим несколько вопросов и предложим формат работы.</p>
    </div>
    
    <div style="max-width:480px;margin:0 auto;">
      <?$APPLICATION->IncludeComponent(
        "bitrix:form",
        "project_form",
        array(
          "IBLOCK_ID" => "",
          "LIST_TEMPLATE" => "",
          "DETAIL_URL" => "",
          "EDIT_URL" => "",
          "SHOW_NEW" => "Y",
          "SHOW_LIST" => "N",
          "CACHE_TIME" => "36000000",
          "CACHE_TYPE" => "A",
        ),
        false
      );?>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
