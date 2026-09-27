<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:cta-form
 * 
 * CTA-блок с формой обратной связи
 * Использует инфоблок page_cta для хранения данных
 */

$arParams['CACHE_TYPE'] = isset($arParams['CACHE_TYPE']) && ($arParams['CACHE_TYPE'] == 'Y' || $arParams['CACHE_TYPE'] == 'N' || $arParams['CACHE_TYPE'] == 'A') ? $arParams['CACHE_TYPE'] : 'A';
$arParams['CACHE_TIME'] = isset($arParams['CACHE_TIME']) ? intval($arParams['CACHE_TIME']) : 3600;

// Кеширование
if ($cache->initCache($arParams['CACHE_TIME'])) {
    $arResult = $cache->getVar('arResult');
} elseif ($cache->startDataCache()) {
    $arResult = array();
}

if (empty($arResult)) {
    // Получение данных из инфоблока
    $arFilter = array(
        'IBLOCK_CODE' => 'page_cta',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_TITLE', 'PROPERTY_DESCRIPTION', 'PROPERTY_TELEGRAM')
    );
    
    if ($arElement = $dbElements->GetNextElement()) {
        $arResult = array(
            'TITLE' => $arElement['PROPERTY_TITLE']['VALUE'],
            'DESCRIPTION' => $arElement['PROPERTY_DESCRIPTION']['VALUE'],
            'TELEGRAM' => $arElement['PROPERTY_TELEGRAM']['VALUE'],
        );
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult)):
    return;
endif;
?>

<section class="section">
  <div class="container">
    <div class="cta-section animate-on-scroll">
      <h2 class="cta-section__title"><?=$arResult['TITLE']?></h2>
      <p class="cta-section__desc"><?=$arResult['DESCRIPTION']?></p>
      <form id="ctaForm" onsubmit="return handleFormSubmit(event)" style="max-width:480px;margin:24px auto 0;text-align:left;">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Имя" required>
        </div>
        <div class="form-group">
          <input type="tel" name="phone" class="form-control" placeholder="Телефон" required>
        </div>
        <div class="form-group">
          <textarea name="message" class="form-control" placeholder="Опишите задачу" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-accent btn-full">Отправить</button>
      </form>
      <?if(!empty($arResult['TELEGRAM'])):?>
      <p style="text-align:center;font-size:0.875rem;color:var(--text-muted);margin-top:16px;" class="animate-on-scroll">
        Или напишите нам в Telegram — ответим быстрее: <a href="https://t.me/dianomi" style="color:var(--accent);" target="_blank" rel="noopener">@dianomi</a>
      </p>
      <?endif;?>
    </div>
  </div>
</section>
