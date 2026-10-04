<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiApproach extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_approach';
    
    public function prepareResult()
    {
        $arResult = array();
        
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        $arSteps = $this->getApproachSteps();
        
        if (empty($arSteps)) {
            $this->abortStep();
            return;
        }
        
        foreach ($arSteps as $step) {
            $arResult['STEPS'][] = array(
                'ID' => intval($step['ID']),
                'STEP_NUMBER' => htmlspecialcharsbx($step['PROPERTY_STEP_NUMBER_VALUE']),
                'TITLE' => htmlspecialcharsbx($step['PROPERTY_TITLE_VALUE']),
            );
        }
        
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
    
    protected function getApproachSteps()
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
                'PROPERTY_STEP_NUMBER',
                'PROPERTY_TITLE',
                'PROPERTY_ORDER',
            ),
            'order' => array('PROPERTY_ORDER' => 'ASC'),
        ));
        
        $results = array();
        while ($arItem = $res->fetch()) {
            $results[] = $arItem;
        }
        
        return $results;
    }
    
    public function getAction()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
    }
}
