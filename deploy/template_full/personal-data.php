<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Dianomi — Согласие на обработку персональных данных");
$APPLICATION->SetPageProperty("description", "Согласие на обработку персональных данных на сайте dianomi.ru.");
$APPLICATION->SetPageProperty("og:title", "Dianomi — Согласие на обработку ПД");
$APPLICATION->SetPageProperty("og:description", "Согласие на обработку персональных данных на сайте dianomi.ru.");
$APPLICATION->SetPageProperty("og:type", "website");
$APPLICATION->SetPageProperty("og:url", "https://dianomi.ru/personal-data.php");
$APPLICATION->SetPageProperty("og:image", "https://dianomi.ru/img/og-default.jpg");
$APPLICATION->SetPageProperty("canonical", "https://dianomi.ru/personal-data.php");
?>

<section class="section">
  <div class="container" style="max-width:800px;">
    <h1>Согласие на обработку персональных данных</h1>
    
    <div style="margin-top:24px; line-height:1.8;">
      <h2>1. Согласие на обработку персональных данных</h2>
      <p>Нажимая кнопку «Отправить» на формах обратной связи, я даю согласие компании Dianomi на обработку моих персональных данных в соответствии с Федеральным законом от 27.07.2006 № 152-ФЗ «О персональных данных».</p>
      
      <h2>2. Перечень данных</h2>
      <p>Я даю согласие на обработку следующих персональных данных:</p>
      <ul>
        <li>ФИО</li>
        <li>Контактный телефон</li>
        <li>Адрес электронной почты</li>
        <li>Название организации</li>
        <li>Должность</li>
        <li>Текст обращения/запроса</li>
      </ul>
      
      <h2>3. Цели обработки</h2>
      <p>Персональные данные обрабатываются для следующих целей:</p>
      <ul>
        <li>Обработки и ответа на обращения</li>
        <li>Связи с заявителем для уточнения деталей</li>
        <li>Предоставления информации об услугах</li>
        <li>Анализа и систематизации обращений</li>
      </ul>
      
      <h2>4. Срок действия согласия</h2>
      <p>Согласие действует с момента его предоставления до момента его отзыва. Согласие может быть отозвано путем направления письменного заявления оператору.</p>
      
      <h2>5. Порядок отзыва</h2>
      <p>Отзыв согласия на обработку персональных данных может быть осуществлен путем направления письменного заявления на адрес электронной почты оператора: info@dianomi.ru</p>
      
      <h2>6. Меры защиты</h2>
      <p>Оператор принимает необходимые организационные и технические меры для защиты персональных данных от несанкционированного доступа и утраты.</p>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
