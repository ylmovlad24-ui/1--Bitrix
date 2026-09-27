<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiProblems extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_problems';
    
    public function prepareResult()
    {
        $arResult = array();
        
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        $arProblems = $this->getProblemsList();
        
        if (empty($arProblems)) {
            $this->abortStep();
            return;
        }
        
        foreach ($arProblems as $problem) {
            $arResult['PROBLEMS'][] = array(
                'ID' => intval($problem['ID']),
                'ICON' => htmlspecialcharsbx($problem['PROPERTY_ICON_VALUE']),
                'TITLE' => htmlspecialcharsbx($problem['PROPERTY_TITLE_VALUE']),
                'DESCRIPTION' => htmlspecialcharsbx($problem['PROPERTY_DESCRIPTION_VALUE']),
            );
        }
        
        $this->arResult = $arResult;
    }
    
    protected function checkRights()
    {
        global $USER;
        
        if (!$USER->isAuthorized()) {
            return false;
        }
        
        $ibID = $this->getIblockID();
        if (!$ibID) {
            return false;
        }
        
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
    
    protected function getProblemsList()
    {
        $res = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_CODE' => self::CODE_IBLOCK,
                'ACTIVE' => 'Y',
            ),
            'select' => array(
                'ID',
                'NAME',
                'PROPERTY_ICON',
                'PROPERTY_TITLE',
                'PROPERTY_DESCRIPTION',
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
