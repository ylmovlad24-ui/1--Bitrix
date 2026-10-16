<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Компонент CTA Form
 * Выводит форму обратной связи с CSRF-защитой
 */
class CBitrixComponentDianomiCtaForm extends CBitrixComponent
{
    /**
     * Выполнение компонента
     */
    public function executeComponent()
    {
        // Автокеширование по канону Bitrix Framework
        if ($this->startResultCache()) {
            $this->prepareResult();
            $this->includeComponentTemplate();
        }
    }

    /**
     * Подготовка данных для шаблона
     */
    public function prepareResult()
    {
        $arResult = array();

        // Проверка прав
        if (!$this->checkRights()) {
            $this->abortStep();
            return;
        }

        // CTA форма не требует данных из инфоблока
        // Генерация CSRF-токена по канону Bitrix Framework (security/csrf-ssrf.md)
        $arResult['CSRF_TOKEN'] = bitrix_sessid();
        $arResult['FORM_ACTION'] = SITE_DIR . 'project.php';

        $this->arResult = $arResult;
    }

    /**
     * Проверка прав (форма доступна всем)
     * @return bool
     */
    protected function checkRights()
    {
        return true;
    }
}
?>
