<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:problems
 * 
 * Блок "Узнаёте себя?" с карточками проблем
 * Использует инфоблок page_problems для хранения данных
 */

$arParams['CACHE_TYPE'] = isset($arParams['CACHE_TYPE']) && ($arParams['CACHE_TYPE'] == 'Y' || $arParams['CACHE_TYPE'] == 'N' || $arParams['CACHE_TYPE'] == 'A') ? $arParams['CACHE_TYPE'] : 'A';
$arParams['CACHE_TIME'] = isset($arParams['CACHE_TIME']) ? intval($arParams['CACHE_TIME']) : 3600;

// Кеширование
if ($cache->initCache($arParams['CACHE_TIME'])) {
    $cacheVars = explode('.', $cache->getVar('cacheVars', md5(serialize($arParams))));
    $arResult = $cache->getVar('arResult');
} elseif ($cache->startDataCache()) {
    $arResult = array();
}

if (empty($arResult)) {
    // Получение данных из инфоблока
    $arFilter = array(
        'IBLOCK_CODE' => 'page_problems',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC', 'ID' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_ICON', 'PROPERTY_TITLE', 'PROPERTY_DESCRIPTION')
    );
    
    $arResult['PROBLEMS'] = array();
    while ($arElement = $dbElements->GetNextElement()) {
        $arResult['PROBLEMS'][] = array(
            'ID' => $arElement['ID'],
            'NAME' => $arElement['NAME'],
            'PROPERTY_ICON' => $arElement['PROPERTY_ICON_VALUE'],
            'PROPERTY_TITLE' => $arElement['PROPERTY_TITLE_VALUE'],
            'PROPERTY_DESCRIPTION' => $arElement['PROPERTY_DESCRIPTION_VALUE'],
        );
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult['PROBLEMS'])):
    return;
endif;
?>

<section class="section section--alt">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Узнаёте себя?</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Если хотя бы одна из этих ситуаций про вашу компанию — пора менять систему</p>
    </div>
    <div style="max-width:960px;margin:0 auto;display:grid;grid-template-columns:repeat(2,1fr);gap:20px 32px;">
      <?foreach($arResult['PROBLEMS'] as $problem):?>
      <div style="padding:20px 24px;background:rgba(42,91,154,0.04);border-radius:12px;border-left:3px solid var(--primary);transition:all 0.3s ease;" 
           onmouseover="this.style.boxShadow='0 4px 12px rgba(42,91,154,0.1)';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.boxShadow='';this.style.transform='';">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
          <span style="font-size:1.25rem;"><?=$problem['PROPERTY_ICON']?></span>
          <strong style="font-size:0.9375rem;color:var(--primary);"><?=$problem['PROPERTY_TITLE']?></strong>
        </div>
        <p style="font-size:0.9375rem;color:var(--text-light);margin:0;line-height:1.7;"><?=$problem['PROPERTY_DESCRIPTION']?></p>
      </div>
      <?endforeach;?>
    </div>
    <div style="text-align:center;margin-top:32px;" class="animate-on-scroll">
      <p style="font-size:1.0625rem;color:var(--text-light);margin-bottom:16px;">Знакомые проблемы? Мы решаем их комплексно — не по одной, а все вместе.</p>
      <a href="/contacts.php" class="btn btn-accent">Обсудить проект</a>
    </div>
  </div>
</section>
