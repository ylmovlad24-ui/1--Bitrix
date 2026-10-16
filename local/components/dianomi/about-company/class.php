<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiAboutCompany extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_about';
    
    public function executeComponent()
    {
        parent::executeComponent();
        
        $arResult = array();
        
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
            'FEATURES' => $arElement['PROPERTY_FEATURES_VALUE'],
        );
        
        $this->arResult = $arResult;
        $this->includeComponentTemplate();
    }
    
    protected function checkRights()
    {
        return true;
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
}
