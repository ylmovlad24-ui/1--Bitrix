<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiHero extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_hero';
    
    public function prepareResult()
    {
        $arResult = array();
        
        // Подключение стилей компонента
        $this->AddExternalStyleSheet(SITE_TEMPLATE_PATH . '/components/common.css');
        
        // Проверка прав
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        // Проверка существования инфоблока
        if (!$this->checkIblockExists()) {
            $this->abortStep();
            return;
        }
        
        // Получение данных из инфоблока
        $arElement = $this->getElementData();
        
        if (!$arElement) {
            $this->abortStep();
            return;
        }
        
        // Подготовка данных для шаблона
        $arResult['ELEMENT'] = array(
            'ID' => intval($arElement['ID']),
            'NAME' => htmlspecialcharsbx($arElement['NAME']),
            'BADGE_TEXT' => htmlspecialcharsbx($arElement['PROPERTY_BADGE_TEXT_VALUE']),
            'TITLE' => htmlspecialcharsbx($arElement['PROPERTY_TITLE_VALUE']),
            'DESCRIPTION' => htmlspecialcharsbx($arElement['PROPERTY_DESCRIPTION_VALUE']),
            'COUNTER_1' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_1_VALUE']),
            'COUNTER_2' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_2_VALUE']),
            'COUNTER_3' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_3_VALUE']),
            'COUNTER_LABEL_1' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_LABEL_1_VALUE']),
            'COUNTER_LABEL_2' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_LABEL_2_VALUE']),
            'COUNTER_LABEL_3' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_LABEL_3_VALUE']),
            // BENEFITS_LIST содержит доверенный HTML-контент, созданный разработчиком
            'BENEFITS_LIST' => $arElement['PROPERTY_BENEFITS_LIST_VALUE'],
        );
        
        $this->arResult = $arResult;
    }
    
    protected function checkRights()
    {
        // Компонент доступен всем для чтения
        return true;
    }
    
    protected function checkIblockExists()
    {
        $ibID = $this->getIblockID();
        return $ibID > 0;
    }
    
    protected function getIblockID()
    {
        static $ibID = null;
        
        if ($ibID === null) {
            $res = IblockTable::getList(array(
                'filter' => array(
                    'CODE' => self::CODE_IBLOCK,
                    'SITE_ID' => SITE_ID,
                ),
                'select' => array('ID'),
                'limit' => 1,
            ));
            
            $ibID = $res->fetch();
            $ibID = $ibID ? intval($ibID['ID']) : 0;
        }
        
        return $ibID;
    }
    
    protected function getElementData()
    {
        $pageCode = $this->arParams['PAGE_CODE'] ?? 'index';
        
        // Валидация входных данных
        $arAllowedPages = array('index', 'about', 'contacts', 'business-systems', 'bitrix24', 'web-systems', '1c-bitrix', 'data-bi');
        if (!in_array($pageCode, $arAllowedPages)) {
            $pageCode = 'index';
        }
        
        $res = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_CODE' => self::CODE_IBLOCK,
                'CODE' => $pageCode,
                'ACTIVE' => 'Y',
                'IBLOCK_LID' => SITE_ID,
            ),
            'select' => array(
                'ID',
                'NAME',
                'PROPERTY_BADGE_TEXT',
                'PROPERTY_TITLE',
                'PROPERTY_DESCRIPTION',
                'PROPERTY_COUNTER_1',
                'PROPERTY_COUNTER_2',
                'PROPERTY_COUNTER_3',
                'PROPERTY_COUNTER_LABEL_1',
                'PROPERTY_COUNTER_LABEL_2',
                'PROPERTY_COUNTER_LABEL_3',
                'PROPERTY_BENEFITS_LIST',
            ),
            'limit' => 1,
        ));
        
        return $res->fetch();
    }
    
    public function getAction()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
    }
}
