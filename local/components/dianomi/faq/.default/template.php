<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:faq
 * 
 * FAQ-аккордеон с вопросами-ответами
 * Использует инфоблок page_faq для хранения данных
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
        'IBLOCK_CODE' => 'page_faq',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_QUESTION', 'PROPERTY_ANSWER')
    );
    
    $arResult['FAQ'] = array();
    while ($arElement = $dbElements->GetNextElement()) {
        $arResult['FAQ'][] = array(
            'QUESTION' => $arElement['PROPERTY_QUESTION']['VALUE'],
            'ANSWER' => $arElement['PROPERTY_ANSWER']['VALUE'],
        );
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult['FAQ'])):
    return;
endif;
?>

<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Частые вопросы</h2>
    </div>
    <div class="faq-list animate-on-scroll">
      <?foreach($arResult['FAQ'] as $faq):?>
      <div class="faq-item">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('faq-item--open')">
          <span><?=$faq['QUESTION']?></span>
          <span class="faq-question__icon">+</span>
        </button>
        <div class="faq-answer">
          <p class="faq-answer__text"><?=$faq['ANSWER']?></p>
        </div>
      </div>
      <?endforeach;?>
    </div>
  </div>
</section>
