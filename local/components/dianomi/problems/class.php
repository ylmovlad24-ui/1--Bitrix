<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;

class CBitrixComponentDianomiProblems extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_problems';
    
    public function executeComponent()
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
        
        // Подготовка данных для шаблона
        foreach ($arProblems as $problem) {
            $arResult['PROBLEMS'][] = array(
                'ID' => $problem['ID'],
                'ICON' => htmlspecialcharsbx($problem['PROPERTY_ICON_VALUE']),
                'TITLE' => htmlspecialcharsbx($problem['PROPERTY_TITLE_VALUE']),
                'DESCRIPTION' => htmlspecialcharsbx($problem['PROPERTY_DESCRIPTION_VALUE']),
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
    
    protected function getProblemsList()
    {
        $res = CIBlockElement::GetList(
            array("PROPERTY_ORDER" => "ASC"),
            array("IBLOCK_CODE" => self::CODE_IBLOCK, "ACTIVE" => "Y"),
            false,
            false,
            array("ID", "NAME", "PROPERTY_ICON", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION", "PROPERTY_ORDER")
        );
        
        $results = array();
        while ($arItem = $res->GetNext()) {
            $results[] = $arItem;
        }
        
        return $results;
    }
}
