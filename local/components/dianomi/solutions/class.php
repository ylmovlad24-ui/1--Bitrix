<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;

class CBitrixComponentDianomiSolutions extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_solutions';
    
    public function executeComponent()
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
                'ID' => $solution['ID'],
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
        $this->includeComponentTemplate();
    }
    
    protected function checkRights()
    {
        global $USER;
        return $USER->isAuthorized();
    }
    
    protected function getSolutionsList()
    {
        $res = CIBlockElement::GetList(
            array("PROPERTY_ORDER" => "ASC"),
            array("IBLOCK_CODE" => self::CODE_IBLOCK, "ACTIVE" => "Y"),
            false,
            false,
            array(
                "ID",
                "NAME",
                "PROPERTY_ICON",
                "PROPERTY_TITLE",
                "PROPERTY_DESCRIPTION",
                "PROPERTY_BENEFITS",
                "PROPERTY_LINK_TEXT",
                "PROPERTY_LINK_URL",
                "PROPERTY_BORDER_COLOR",
                "PROPERTY_ORDER",
            )
        );
        
        $results = array();
        while ($arItem = $res->GetNext()) {
            $results[] = $arItem;
        }
        
        return $results;
    }
}
