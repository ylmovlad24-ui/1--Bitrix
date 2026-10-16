<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiFaq extends CBitrixComponent
{
    const CODE_IBLOCK = 'page_faq';
    
    public function executeComponent()
    {
        parent::executeComponent();
        
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
                'ID' => intval($faq['ID']),
                'QUESTION' => htmlspecialcharsbx($faq['PROPERTY_QUESTION_VALUE']),
                'ANSWER' => $faq['PROPERTY_ANSWER_VALUE'],
            );
        }
        
        $this->arResult = $arResult;
        $this->includeComponentTemplate();
    }
    
    protected function checkRights()
    {
        return true;
    }
    
    protected function getFaqList()
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
                'PROPERTY_QUESTION',
                'PROPERTY_ANSWER',
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
