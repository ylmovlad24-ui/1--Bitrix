<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiAboutCompany extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_about';
    
    public function prepareResult()
    {
        $arResult = array();
        
        // Подключение стилей компонента
        $this->AddExternalStyleSheet(SITE_TEMPLATE_PATH . '/components/common.css');
        
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        $arElement = $this->getElementData();
        
        if (!$arElement) {
            $this->abortStep();
            return;
        }
        
        $arResult['ELEMENT'] = array(
            'ID' => intval($arElement['ID']),
            'DESCRIPTION' => htmlspecialcharsbx($arElement['PROPERTY_DESCRIPTION_VALUE']),
            'OFFICE' => htmlspecialcharsbx($arElement['PROPERTY_OFFICE_VALUE']),
            // FEATURES содержит доверенный текст (каждая строка — новое преимущество)
            'FEATURES' => $arElement['PROPERTY_FEATURES_VALUE'],
        );
        
        $this->arResult = $arResult;
    }
    
    protected function checkRights()
    {
        // Компонент доступен всем для чтения
        return true;
    }
    
    protected function getIblockID()
    {
        static $ibID = null;
        
        if ($ibID === null) {
            $res = \Bitrix\Iblock\IblockTable::getList(array(
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
        $res = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_CODE' => self::CODE_IBLOCK,
                'ACTIVE' => 'Y',
                'IBLOCK_LID' => SITE_ID,
            ),
            'select' => array(
                'ID',
                'NAME',
                'PROPERTY_DESCRIPTION',
                'PROPERTY_OFFICE',
                'PROPERTY_FEATURES',
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
