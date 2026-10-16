<?php
namespace Bitrix\Dianomi\Hero;

use Bitrix\Main;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Engine\Contracts\ICacheable;

class Hero extends Main\Base implements ICacheable
{
    const CODE_IBLOCK = 'page_hero';
    
    public function executeComponent(): void
    {
        $arResult = array();
        
        // Проверка прав
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }
        
        // Получение данных из инфоблока
        $arElement = $this->getElementData();
        
        if (!$arElement) {
            $this->abortStep();
            return;
        }
        
        // Подготовка данных для шаблона
        $arResult['ELEMENT'] = array(
            'ID' => $arElement->getId(),
            'NAME' => $arElement->getName(),
            'BADGE_TEXT' => htmlspecialcharsbx($arElement->getProperty('BADGE_TEXT')->getValue()),
            'TITLE' => htmlspecialcharsbx($arElement->getProperty('TITLE')->getValue()),
            'DESCRIPTION' => htmlspecialcharsbx($arElement->getProperty('DESCRIPTION')->getValue()),
            'COUNTER_1' => htmlspecialcharsbx($arElement->getProperty('COUNTER_1')->getValue()),
            'COUNTER_2' => htmlspecialcharsbx($arElement->getProperty('COUNTER_2')->getValue()),
            'COUNTER_3' => htmlspecialcharsbx($arElement->getProperty('COUNTER_3')->getValue()),
            'COUNTER_LABEL_1' => htmlspecialcharsbx($arElement->getProperty('COUNTER_LABEL_1')->getValue()),
            'COUNTER_LABEL_2' => htmlspecialcharsbx($arElement->getProperty('COUNTER_LABEL_2')->getValue()),
            'COUNTER_LABEL_3' => htmlspecialcharsbx($arElement->getProperty('COUNTER_LABEL_3')->getValue()),
            'BENEFITS_LIST' => $arElement->getProperty('BENEFITS_LIST')->getValue(),
        );
        
        $this->arResult = $arResult;
        $this->includeComponentTemplate();
    }
    
    protected function checkRights(): bool
    {
        // Проверка прав на чтение инфоблока
        global $USER;
        return $USER->isAuthorized();
    }
    
    protected function getElementData(): ?\Bitrix\Iblock\Element
    {
        $pageCode = $this->arParams['PAGE_CODE'] ?? 'index';
        
        $dbResult = ElementTable::getList(array(
            'filter' => array(
                'IBLOCK_CODE' => self::CODE_IBLOCK,
                'CODE' => $pageCode,
                'ACTIVE' => 'Y',
            ),
            'select' => array(
                'ID',
                'NAME',
                'PROPERTY_BADGE_TEXT',
                'PROPERTY_TITLE',
                'PROPERTY_DESCRIPTION',
                'PROPERTY_COUNTER_1',
                'PROPERTY_COUNTER_2',
                'PROPERTY_COUNTER_3',
                'PROPERTY_COUNTER_LABEL_1',
                'PROPERTY_COUNTER_LABEL_2',
                'PROPERTY_COUNTER_LABEL_3',
                'PROPERTY_BENEFITS_LIST',
            ),
            'limit' => 1,
        ));
        
        return $dbResult->fetch();
    }
    
    public function getCacheSettings(): array
    {
        return array(
            'fmt' => 'a:2:{s:7:"arResult";a:0:{}}',
            'id' => $this->getCacheId(),
            'te' => 0,
        );
    }
    
    private function getCacheId(): string
    {
        return 'dianomi_hero_' . ($this->arParams['PAGE_CODE'] ?? 'index');
    }
}
