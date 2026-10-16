<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiApproach extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_approach';
    
    public function executeComponent()
    {
        parent::executeComponent();
        
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
        $this->includeComponentTemplate();
    }
    
    protected function checkRights()
    {
        return true;
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
}
