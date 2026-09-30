<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component Template: bitrix:form - project_form
 * 
 * Кастомный шаблон формы обратной связи для страницы project.php
 * Имитирует текущий вид формы из статического сайта
 */

if (!isset($arResult['FORM_TYPE'])):
    return;
endif;
?>

<form id="ctaForm" onsubmit="return handleFormSubmit(event)" style="max-width:480px;margin:24px auto 0;text-align:left;">
  <div class="form-group">
    <input type="text" name="NAME" class="form-control" placeholder="Имя" required>
  </div>
  <div class="form-group">
    <input type="tel" name="PHONE" class="form-control" placeholder="Телефон" required>
  </div>
  <div class="form-group">
    <textarea name="MESSAGE" class="form-control" placeholder="Опишите задачу" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-accent btn-full">Отправить</button>
</form>

<?if(!empty($arResult['FORM_ERRORS'])):?>
  <div style="color:#e74c3c;margin-top:16px;text-align:center;">
    <?foreach($arResult['FORM_ERRORS'] as $error):?>
      <p style="margin:4px 0;"><?=$error?></p>
    <?endforeach;?>
  </div>
<?endif;?>

<?if(!empty($arResult['SUCCESS_MESSAGE'])):?>
  <div style="color:#27ae60;margin-top:16px;text-align:center;">
    <p><?=$arResult['SUCCESS_MESSAGE']?></p>
  </div>
<?endif;?>
