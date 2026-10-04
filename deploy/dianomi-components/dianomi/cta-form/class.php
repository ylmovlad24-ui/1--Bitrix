<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiCtaForm extends CBitrixComponent
{
    public function prepareResult()
    {
        $arResult = array();
        
        // CTA форма не требует данных из инфоблока
        $arResult['FORM_ACTION'] = '/project.php';
        
        $this->arResult = $arResult;
    }
    
    protected function checkRights()
    {
        // Форма доступна всем
        return true;
    }
    
    public function getAction()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
    }
}
