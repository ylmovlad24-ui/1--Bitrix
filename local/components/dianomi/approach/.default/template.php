<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:approach
 * 
 * Шаги "Наш подход: от картины к деталям"
 * Использует инфоблок page_approach для хранения данных
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
        'IBLOCK_CODE' => 'page_approach',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_STEP', 'PROPERTY_TITLE')
    );
    
    $arResult['STEPS'] = array();
    while ($arElement = $dbElements->GetNextElement()) {
        $arResult['STEPS'][] = array(
            'STEP' => $arElement['PROPERTY_STEP']['VALUE'],
            'TITLE' => $arElement['PROPERTY_TITLE']['VALUE'],
        );
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult['STEPS'])):
    return;
endif;
?>

<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Наш подход: от картины к деталям</h2>
    </div>
    <div style="max-width:960px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <?foreach($arResult['STEPS'] as $step):?>
      <div style="background:#fff;border:1px solid var(--border);border-radius:12px;padding:24px;box-shadow:var(--shadow-sm);transition:all 0.3s ease;border-top:3px solid var(--accent);" 
           onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-2px)';this.style.borderColor='var(--primary)';" 
           onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='';this.style.borderColor='var(--border)';">
        <div style="width:40px;height:40px;border-radius:50%;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.125rem;font-weight:700;margin-bottom:16px;"><?=$step['STEP']?></div>
        <h4 style="font-size:1rem;font-weight:600;margin:0;line-height:1.4;"><?=$step['TITLE']?></h4>
      </div>
      <?endforeach;?>
    </div>
    <div style="text-align:center;margin-top:24px;" class="animate-on-scroll">
      <a href="/about.php" class="btn btn-outline">Как мы работаем</a>
    </div>
  </div>
</section>
