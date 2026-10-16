<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

// Установка HTTP статуса 404 по канону Bitrix
$showIndexSection = true;
$APPLICATION->SetFile404Page(true);

$APPLICATION->SetTitle("Dianomi — Страница не найдена");
$APPLICATION->SetPageProperty("description", "Запрашиваемая страница не существует.");
$APPLICATION->SetPageProperty("og:title", "Dianomi — Страница не найдена");
$APPLICATION->SetPageProperty("og:description", "Запрашиваемая страница не существует.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/404.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/");
?>

<section class="section">
  <div class="container">
    <div class="page-hero" style="text-align:center;">
      <h1>Страница не найдена</h1>
      <p>Запрашиваемая страница не существует</p>
    </div>
    
    <div style="text-align:center; margin-top:32px;">
      <a href="<?=SITE_DIR?>" class="btn btn-primary">Вернуться на главную</a>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
