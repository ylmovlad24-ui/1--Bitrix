<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:about-company
 * 
 * Блок "О Dianomi" с описанием компании и преимуществами
 * Использует инфоблок page_about для хранения данных
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
        'IBLOCK_CODE' => 'page_about',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_TYPE', 'PROPERTY_TEXT', 'PROPERTY_TITLE')
    );
    
    $arResult['DESCRIPTION'] = array();
    $arResult['ADVANTAGES'] = array();
    
    while ($arElement = $dbElements->GetNextElement()) {
        $props = $arElement->GetProperties();
        if ($props['TYPE']['VALUE'] == 'description') {
            $arResult['DESCRIPTION'][] = array(
                'TEXT' => $props['TEXT']['VALUE'],
            );
        } elseif ($props['TYPE']['VALUE'] == 'advantage') {
            $arResult['ADVANTAGES'][] = array(
                'TITLE' => $props['TITLE']['VALUE'],
            );
        }
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult['DESCRIPTION']) && empty($arResult['ADVANTAGES'])):
    return;
endif;
?>

<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">О Dianomi</h2>
    </div>
    <?if(!empty($arResult['DESCRIPTION'])):?>
    <div style="max-width:720px;margin:0 auto 32px;" class="animate-on-scroll">
      <?foreach($arResult['DESCRIPTION'] as $desc):?>
      <p style="font-size:1.0625rem;color:var(--text-light);line-height:1.8;margin-bottom:24px;"><?=$desc['TEXT']?></p>
      <?endforeach;?>
    </div>
    <?endif;?>
    <?if(!empty($arResult['ADVANTAGES'])):?>
    <div class="grid grid--2" style="max-width:720px;margin:0 auto;">
      <?foreach($arResult['ADVANTAGES'] as $advantage):?>
      <div class="solution-card animate-on-scroll">
        <h3 style="font-size:1rem;margin-bottom:8px;"><?=$advantage['TITLE']?></h3>
        <p class="solution-card__desc">Проектируем архитектуру, в которой всё связано.</p>
      </div>
      <?endforeach;?>
    </div>
    <?endif;?>
  </div>
</section>
