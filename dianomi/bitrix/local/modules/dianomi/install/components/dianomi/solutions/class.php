<?php
namespace Bitrix\Dianomi\Solutions;

use Bitrix\Main;
use Bitrix\Iblock\ElementTable;

class Solutions extends Main\Base
{
    const CODE_IBLOCK = 'page_solutions';
    
    public function executeComponent(): void
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
                'ID' => $solution->getId(),
                'ICON' => htmlspecialcharsbx($solution->getProperty('ICON')->getValue()),
                'TITLE' => htmlspecialcharsbx($solution->getProperty('TITLE')->getValue()),
                'DESCRIPTION' => htmlspecialcharsbx($solution->getProperty('DESCRIPTION')->getValue()),
                'BENEFITS' => $solution->getProperty('BENEFITS')->getValue(),
                'LINK_TEXT' => htmlspecialcharsbx($solution->getProperty('LINK_TEXT')->getValue()),
                'LINK_URL' => htmlspecialcharsbx($solution->getProperty('LINK_URL')->getValue()),
                'BORDER_COLOR' => htmlspecialcharsbx($solution->getProperty('BORDER_COLOR')->getValue()),
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
    
    protected function getSolutionsList(): array
    {
        $dbResult = ElementTable::getList(array(
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
                'PROPERTY_BENEFITS',
                'PROPERTY_LINK_TEXT',
                'PROPERTY_LINK_URL',
                'PROPERTY_BORDER_COLOR',
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
