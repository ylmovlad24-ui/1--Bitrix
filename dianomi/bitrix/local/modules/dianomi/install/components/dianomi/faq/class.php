<?php
namespace Bitrix\Dianomi\Faq;

use Bitrix\Main;
use Bitrix\Iblock\ElementTable;

class Faq extends Main\Base
{
    const CODE_IBLOCK = 'page_faq';
    
    public function executeComponent(): void
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
                'ID' => $faq->getId(),
                'QUESTION' => htmlspecialcharsbx($faq->getProperty('QUESTION')->getValue()),
                'ANSWER' => $faq->getProperty('ANSWER')->getValue(),
            );
        }
        
        $this->arResult = $arResult;
        $this->includeComponentTemplate();
    }
    
    protected function checkRights(): bool
    {
        global $USER;
        return $USER->isAuthorized();
    }
    
    protected function getFaqList(): array
    {
        $dbResult = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_CODE' => self::CODE_IBLOCK,
                'ACTIVE' => 'Y',
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
        while ($arItem = $dbResult->fetch()) {
            $results[] = $arItem;
        }
        
        return $results;
    }
}
