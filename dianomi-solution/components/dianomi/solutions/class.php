<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiSolutions extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_solutions';
    
    public function prepareResult()
    {
        $arResult = array();
        
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        $arSolutions = $this->getSolutionsList();
        
        if (empty($arSolutions)) {
            $this->abortStep();
            return;
        }
        
        foreach ($arSolutions as $solution) {
            $arResult['SOLUTIONS'][] = array(
                'ID' => intval($solution['ID']),
                'ICON' => htmlspecialcharsbx($solution['PROPERTY_ICON_VALUE']),
                'TITLE' => htmlspecialcharsbx($solution['PROPERTY_TITLE_VALUE']),
                'DESCRIPTION' => htmlspecialcharsbx($solution['PROPERTY_DESCRIPTION_VALUE']),
                'BENEFITS' => $solution['PROPERTY_BENEFITS_VALUE'],
                'LINK_TEXT' => htmlspecialcharsbx($solution['PROPERTY_LINK_TEXT_VALUE']),
                'LINK_URL' => htmlspecialcharsbx($solution['PROPERTY_LINK_URL_VALUE']),
                'BORDER_COLOR' => htmlspecialcharsbx($solution['PROPERTY_BORDER_COLOR_VALUE']),
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
    
    protected function getSolutionsList()
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
                'PROPERTY_ICON',
                'PROPERTY_TITLE',
                'PROPERTY_DESCRIPTION',
                'PROPERTY_BENEFITS',
                'PROPERTY_LINK_TEXT',
                'PROPERTY_LINK_URL',
                'PROPERTY_BORDER_COLOR',
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
