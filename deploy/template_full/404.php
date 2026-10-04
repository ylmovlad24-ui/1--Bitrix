<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена — Dianomi");

$APPLICATION->SetPageProperty("description", "Запрашиваемая страница не существует. Вернитесь на главную или выберите раздел.");
$APPLICATION->SetPageProperty("og:title", "Страница не найдена — Dianomi");
$APPLICATION->SetPageProperty("og:description", "Запрашиваемая страница не существует. Вернитесь на главную или выберите раздел.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/404.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/404.php");
?>

<main id="main-content">

<section class="page-hero">
  <div class="container">
    <h1 class="page-hero__title">Страница не найдена</h1>
    <p class="page-hero__subtitle">Запрашиваемая страница не существует</p>
  </div>
</section>

<section class="section">
  <div class="container" style="text-align:center;">
    <a href="/" class="btn btn-accent">Вернуться на главную</a>
  </div>
</section>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
