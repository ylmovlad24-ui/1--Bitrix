<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:before-after
 * 
 * Блок "До/После" - показывает изменения после проекта
 * Использует инфоблок page_before_after для хранения данных
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
        'IBLOCK_CODE' => 'page_before_after',
        'ACTIVE' => 'Y',
    );
    
    $dbElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_TYPE', 'PROPERTY_ITEM')
    );
    
    $arResult['BEFORE'] = array();
    $arResult['AFTER'] = array();
    
    while ($arElement = $dbElements->GetNextElement()) {
        $props = $arElement->GetProperties();
        if ($props['TYPE']['VALUE'] == 'before') {
            $arResult['BEFORE'][] = array(
                'TEXT' => $props['ITEM']['VALUE'],
            );
        } elseif ($props['TYPE']['VALUE'] == 'after') {
            $arResult['AFTER'][] = array(
                'TEXT' => $props['ITEM']['VALUE'],
            );
        }
    }
    
    $cache->endDataCache($arResult);
}

if (empty($arResult['BEFORE']) || empty($arResult['AFTER'])):
    return;
endif;
?>

<section class="section">
  <div class="container">
    <div class="section-heading animate-on-scroll">
      <h2 class="section-heading__title">Как изменится работа после проекта</h2>
    </div>
    <div style="max-width:960px;margin:0 auto;">
      <div style="display:flex;gap:0;position:relative;overflow:hidden;border-radius:16px;border:1px solid var(--border);box-shadow:var(--shadow-md);">
        <!-- До -->
        <div style="background:linear-gradient(to right, rgba(231,76,60,0.04), transparent 60%);padding:40px 32px;flex:1;border-right:1px solid var(--border);">
          <h3 style="font-size:0.8125rem;font-weight:600;margin:0 0 28px;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);">До проекта</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;">
            <?foreach($arResult['BEFORE'] as $item):?>
            <li style="font-size:0.9375rem;line-height:1.6;color:var(--text-light);"><?=$item['TEXT']?></li>
            <?endforeach;?>
          </ul>
        </div>
        <!-- Разделитель -->
        <div style="width:1px;background:var(--border);position:relative;flex-shrink:0;">
          <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:24px;height:24px;border-radius:50%;background:var(--bg-alt);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:12px;color:var(--text-muted);">→</div>
        </div>
        <!-- После -->
        <div style="background:linear-gradient(to right, rgba(39,174,96,0.03), transparent 40%), #fff;padding:40px 32px;flex:1;">
          <h3 style="font-size:0.8125rem;font-weight:600;margin:0 0 28px;text-transform:uppercase;letter-spacing:0.08em;color:var(--accent);">После проекта</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;">
            <?foreach($arResult['AFTER'] as $item):?>
            <li style="display:flex;align-items:flex-start;gap:12px;font-size:0.9375rem;line-height:1.6;color:var(--text-dark);">
              <span style="flex-shrink:0;width:20px;height:20px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;margin-top:1px;">✓</span>
              <span><?=$item['TEXT']?></span>
            </li>
            <?endforeach;?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
