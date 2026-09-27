<?php
namespace Bitrix\Dianomi\Problems;

use Bitrix\Main;
use Bitrix\Iblock\ElementTable;

class Problems extends Main\Base
{
    const CODE_IBLOCK = 'page_problems';
    
    public function executeComponent(): void
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
                'ID' => $problem->getId(),
                'ICON' => htmlspecialcharsbx($problem->getProperty('ICON')->getValue()),
                'TITLE' => htmlspecialcharsbx($problem->getProperty('TITLE')->getValue()),
                'DESCRIPTION' => htmlspecialcharsbx($problem->getProperty('DESCRIPTION')->getValue()),
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
    
    protected function getProblemsList(): array
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
