<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена — Dianomi");
?>

<section class="section">
  <div class="container" style="text-align:center;">
    <h1 style="font-size:4rem;font-weight:700;margin-bottom:16px;color:var(--primary);">404</h1>
    <h2 style="font-size:1.5rem;font-weight:600;margin-bottom:16px;">Страница не найдена</h2>
    <p style="font-size:1.125rem;color:var(--text-light);margin-bottom:32px;">
      Запрашиваемая страница не существует или была перемещена.
    </p>
    <a href="/" class="btn btn-accent">Вернуться на главную</a>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
