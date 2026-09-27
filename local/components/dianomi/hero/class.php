<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Iblock\ElementTable;

class CBitrixComponentDianomiHero extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_hero';
    
    public function executeComponent()
    {
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
        
        // Подготовка данных для шаблона с безопасным выводом
        $arResult['ELEMENT'] = array(
            'ID' => $arElement['ID'],
            'NAME' => $arElement['NAME'],
            'BADGE_TEXT' => htmlspecialcharsbx($arElement['PROPERTY_BADGE_TEXT_VALUE']),
            'TITLE' => htmlspecialcharsbx($arElement['PROPERTY_TITLE_VALUE']),
            'DESCRIPTION' => htmlspecialcharsbx($arElement['PROPERTY_DESCRIPTION_VALUE']),
            'COUNTER_1' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_1_VALUE']),
            'COUNTER_2' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_2_VALUE']),
            'COUNTER_3' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_3_VALUE']),
            'COUNTER_LABEL_1' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_LABEL_1_VALUE']),
            'COUNTER_LABEL_2' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_LABEL_2_VALUE']),
            'COUNTER_LABEL_3' => htmlspecialcharsbx($arElement['PROPERTY_COUNTER_LABEL_3_VALUE']),
            'BENEFITS_LIST' => $arElement['PROPERTY_BENEFITS_LIST_VALUE'],
        );
        
        $this->arResult = $arResult;
        $this->includeComponentTemplate();
    }
    
    protected function checkRights()
    {
        global $USER;
        return $USER->isAuthorized();
    }
    
    protected function getElementData()
    {
        $pageCode = $this->arParams['PAGE_CODE'] ?? 'index';
        
        $res = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_CODE" => self::CODE_IBLOCK,
                "CODE" => $pageCode,
                "ACTIVE" => "Y",
            ),
            false,
            false,
            array(
                "ID",
                "NAME",
                "PROPERTY_BADGE_TEXT",
                "PROPERTY_TITLE",
                "PROPERTY_DESCRIPTION",
                "PROPERTY_COUNTER_1",
                "PROPERTY_COUNTER_2",
                "PROPERTY_COUNTER_3",
                "PROPERTY_COUNTER_LABEL_1",
                "PROPERTY_COUNTER_LABEL_2",
                "PROPERTY_COUNTER_LABEL_3",
                "PROPERTY_BENEFITS_LIST",
            )
        );
        
        return $res->GetNext();
    }
}
