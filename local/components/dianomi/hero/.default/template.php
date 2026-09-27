<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix Component: dianomi:hero
 * 
 * Hero-секция с заголовком, описанием, счётчиками и списком преимуществ
 * Использует инфоблок page_hero для хранения данных
 */

$MESSAGES = array(
    'CHECK_ACCESS' => 'Доступ к информации ограничен.',
    'NO_DATA' => 'Данные не найдены.',
);

$arParams['CACHE_TYPE'] = isset($arParams['CACHE_TYPE']) && ($arParams['CACHE_TYPE'] == 'Y' || $arParams['CACHE_TYPE'] == 'N' || $arParams['CACHE_TYPE'] == 'A') ? $arParams['CACHE_TYPE'] : 'A';
$arParams['CACHE_TIME'] = isset($arParams['CACHE_TIME']) ? intval($arParams['CACHE_TIME']) : 3600;
$arParams['PAGE_CODE'] = isset($arParams['PAGE_CODE']) ? $arParams['PAGE_CODE'] : '';

if ($arParams['PAGE_CODE'] == '') {
    return;
}

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
        'IBLOCK_CODE' => 'page_hero',
        'CODE' => $arParams['PAGE_CODE'],
        'ACTIVE' => 'Y',
    );
    
    $dbElement = CIBlockElement::GetList(
        array(),
        $arFilter,
        false,
        false,
        array('ID', 'NAME', 'PROPERTY_BADGE_TEXT', 'PROPERTY_TITLE', 'PROPERTY_DESCRIPTION',
              'PROPERTY_COUNTER_1', 'PROPERTY_COUNTER_2', 'PROPERTY_COUNTER_3',
              'PROPERTY_COUNTER_LABEL_1', 'PROPERTY_COUNTER_LABEL_2', 'PROPERTY_COUNTER_LABEL_3',
              'PROPERTY_BENEFITS_LIST')
    );
    
    if ($arElement = $dbElement->GetNextElement()) {
        $arResult = $arElement->GetFields();
        $arResult['PROPERTIES'] = $arElement->GetProperties();
    }
    
    $cache->endDataCache($arResult);
}

$this->SetViewProperty('og:title', $arResult['PROPERTIES']['TITLE']['VALUE'] ?: 'Dianomi');
$this->SetViewProperty('og:description', $arResult['PROPERTIES']['DESCRIPTION']['VALUE'] ?: '');
$this->SetViewProperty('og:image', '/img/og-default.jpg');

if (empty($arResult)):
    return;
endif;
?>

<section class="hero">
  <div class="container">
    <div class="hero__inner">
      <div class="hero__content">
        <div class="hero__badge animate-on-scroll">
          <svg viewBox="0 0 16 16" fill="none" width="16" height="16">
            <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
            <path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <?=htmlspecialcharsbx($arResult['PROPERTIES']['BADGE_TEXT']['VALUE'])?>
        </div>
        <h1 class="hero__title animate-on-scroll">
          <?=$arResult['PROPERTIES']['TITLE']['VALUE']?>
        </h1>
        <p class="hero__desc animate-on-scroll">
          <?=htmlspecialcharsbx($arResult['PROPERTIES']['DESCRIPTION']['VALUE'])?>
        </p>
        <div class="hero__actions animate-on-scroll">
          <a href="/contacts.php" class="btn btn-accent">Обсудить проект</a>
          <a href="#route" class="btn btn-outline">Посмотреть решения</a>
        </div>
        <div class="hero-stats" style="display:flex;gap:32px;justify-content:center;margin-top:48px;">
          <div class="hero-stat" style="text-align:center;">
            <div class="hero__stat-number" data-count="<?=$arResult['PROPERTIES']['COUNTER_1']['VALUE']?>" style="font-size:1.75rem;">0</div>
            <div class="hero__stat-label"><?=$arResult['PROPERTIES']['COUNTER_LABEL_1']['VALUE']?></div>
          </div>
          <div class="hero-stat" style="text-align:center;">
            <div class="hero__stat-number" data-count="<?=$arResult['PROPERTIES']['COUNTER_2']['VALUE']?>" style="font-size:1.75rem;">0</div>
            <div class="hero__stat-label"><?=$arResult['PROPERTIES']['COUNTER_LABEL_2']['VALUE']?></div>
          </div>
          <div class="hero-stat" style="text-align:center;">
            <div class="hero__stat-number" style="font-size:1.75rem;"><?=$arResult['PROPERTIES']['COUNTER_3']['VALUE']?></div>
            <div class="hero__stat-label"><?=$arResult['PROPERTIES']['COUNTER_LABEL_3']['VALUE']?></div>
          </div>
        </div>
      </div>
      <div class="hero__visual animate-on-scroll">
        <div style="background:linear-gradient(135deg, #1E4474, #2A5B9A);border:1px solid rgba(42,91,154,0.6);border-radius:20px;padding:36px;box-shadow:0 8px 32px rgba(0,0,0,0.15);position:relative;overflow:hidden;">
          <h3 style="font-size:1.1875rem;font-weight:700;margin:0 0 28px;color:#fff;">Что решаем вместе:</h3>
          <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:18px;">
            <?=$arResult['PROPERTIES']['BENEFITS_LIST']['VALUE']?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
