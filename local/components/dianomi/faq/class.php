<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;

class CBitrixComponentDianomiFaq extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_faq';
    
    public function executeComponent()
    {
        $arResult = array();
        
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        $arFaqs = $this->getFaqList();
        
        if (empty($arFaqs)) {
            $this->abortStep();
            return;
        }
        
        foreach ($arFaqs as $faq) {
            $arResult['FAQ'][] = array(
                'ID' => $faq['ID'],
                'QUESTION' => htmlspecialcharsbx($faq['PROPERTY_QUESTION_VALUE']),
                'ANSWER' => $faq['PROPERTY_ANSWER_VALUE'],
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
    
    protected function getFaqList()
    {
        $res = CIBlockElement::GetList(
            array("PROPERTY_ORDER" => "ASC"),
            array("IBLOCK_CODE" => self::CODE_IBLOCK, "ACTIVE" => "Y"),
            false,
            false,
            array("ID", "NAME", "PROPERTY_QUESTION", "PROPERTY_ANSWER", "PROPERTY_ORDER")
        );
        
        $results = array();
        while ($arItem = $res->GetNext()) {
            $results[] = $arItem;
        }
        
        return $results;
    }
}
