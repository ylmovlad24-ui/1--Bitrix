<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CBitrixComponentDianomiCtaForm extends CBitrixComponent
{
    public function executeComponent()
    {
        parent::executeComponent();
        
        $arResult = array();
        
        // CTA форма не требует данных из инфоблока
        $arResult['FORM_ACTION'] = SITE_DIR . 'project.php';
        
        $this->arResult = $arResult;
        $this->includeComponentTemplate();
    }
}
