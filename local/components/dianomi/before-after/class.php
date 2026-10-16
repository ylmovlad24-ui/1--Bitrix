<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiBeforeAfter extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_before_after';
    
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
            'BEFORE_TITLE' => htmlspecialcharsbx($arElement['PROPERTY_BEFORE_TITLE_VALUE']),
            'AFTER_TITLE' => htmlspecialcharsbx($arElement['PROPERTY_AFTER_TITLE_VALUE']),
            'BEFORE_LIST' => $arElement['PROPERTY_BEFORE_LIST_VALUE'],
            'AFTER_LIST' => $arElement['PROPERTY_AFTER_LIST_VALUE'],
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
                'PROPERTY_BEFORE_TITLE',
                'PROPERTY_AFTER_TITLE',
                'PROPERTY_BEFORE_LIST',
                'PROPERTY_AFTER_LIST',
            ),
            'limit' => 1,
        ));
        
        return $res->fetch();
    }
}
