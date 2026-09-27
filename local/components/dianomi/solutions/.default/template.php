<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:solutions
 * 
 * Карточки решений
 * Использует инфоблок page_solutions для хранения данных
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
        'IBLOCK_CODE' => 'page_solutions',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC', 'ID' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_ICON', 'PROPERTY_TITLE', 'PROPERTY_DESCRIPTION',
              'PROPERTY_BENEFITS', 'PROPERTY_LINK_TEXT', 'PROPERTY_LINK_URL')
    );
    
    $arResult['SOLUTIONS'] = array();
    while ($arElement = $dbElements->GetNextElement()) {
        $arResult['SOLUTIONS'][] = array(
            'ID' => $arElement['ID'],
            'NAME' => $arElement['NAME'],
            'PROPERTY_ICON' => $arElement['PROPERTY_ICON']['VALUE'],
            'PROPERTY_TITLE' => $arElement['PROPERTY_TITLE']['VALUE'],
            'PROPERTY_DESCRIPTION' => $arElement['PROPERTY_DESCRIPTION']['VALUE'],
            'PROPERTY_BENEFITS' => $arElement['PROPERTY_BENEFITS']['VALUE'],
            'PROPERTY_LINK_TEXT' => $arElement['PROPERTY_LINK_TEXT']['VALUE'],
            'PROPERTY_LINK_URL' => $arElement['PROPERTY_LINK_URL']['VALUE'],
        );
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult['SOLUTIONS'])):
    return;
endif;
?>

<section class="section" id="route">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Какая у вас задача?</h2>
      <p class="section-heading__subtitle" style="max-width:640px;margin:12px auto 0;">Выберите направление — перейдёте к подробному описанию решений</p>
    </div>
    <div class="grid grid--3" style="max-width:960px;margin:0 auto;">
      <?foreach($arResult['SOLUTIONS'] as $index => $solution):
        $borderColors = array('var(--primary)', 'var(--accent)', 'var(--success)');
        $borderColor = $borderColors[$index % count($borderColors)];
      ?>
      <div class="solution-card animate-on-scroll" style="border-top:4px solid <?=$borderColor?>;">
        <div class="solution-card__icon"><?=$solution['PROPERTY_ICON']?></div>
        <h3 class="solution-card__title"><?=$solution['PROPERTY_TITLE']?></h3>
        <p class="solution-card__desc"><?=$solution['PROPERTY_DESCRIPTION']?></p>
        <div style="margin:12px 0;padding:12px 0;border-top:1px solid var(--border);border-bottom:1px solid var(--border);">
          <p style="font-size:0.8125rem;font-weight:600;color:var(--text-dark);margin:0 0 8px;text-transform:uppercase;letter-spacing:0.05em;">Что получите:</p>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px;">
            <?=$solution['PROPERTY_BENEFITS']?>
          </ul>
        </div>
        <a href="<?=$solution['PROPERTY_LINK_URL']?>" class="solution-card__link"><?=$solution['PROPERTY_LINK_TEXT']?> →</a>
      </div>
      <?endforeach;?>
    </div>
  </div>
</section>
