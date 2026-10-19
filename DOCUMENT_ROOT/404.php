<?php
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Stranica ne naydena');
?>

<main id="main-content">
<!-- Page Hero -->
<section class="page-hero" style="padding:calc(var(--header-height) + 48px) 0 48px;">
  <div class="container">
    <h1 class="page-hero__title" style="color:#FFF;font-size:4rem;">404</h1>
  </div>
</section>

<!-- 404 Message -->
<section class="section">
  <div class="container">
    <div style="text-align:center;max-width:520px;margin:0 auto;" class="animate-on-scroll">
      <h2 style="font-size:1.5rem;margin-bottom:12px;">Страница не найдена</h2>
      <p style="font-size:1.0625rem;color:var(--text-light);line-height:1.7;margin-bottom:32px;">
        Запрашиваемая страница не существует или была перемещена. Вернитесь на главную или выберите раздел сайта.
      </p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
        <a href="/index.php" class="btn btn-accent">На главную</a>
        <a href="/contacts/" class="btn btn-outline">Контакты</a>
      </div>
    </div>
  </div>
</section>
</main>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
