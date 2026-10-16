<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

/**
 * Компонент Approach Section
 * Выводит этапы работы (подход Dianomi)
 */
class CBitrixComponentDianomiApproach extends CBitrixComponentDianomiBase
{
    const CODE_IBLOCK = 'page_approach';

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

        // Проверка существования инфоблока
        if (!$this->checkIblockExists(self::CODE_IBLOCK)) {
            $this->abortStep();
            return;
        }

        // Получение этапов работы
        $arSteps = $this->getApproachSteps();

        if (empty($arSteps)) {
            $this->abortStep();
            return;
        }

        // Подготовка данных для шаблона
        foreach ($arSteps as $step) {
            $arResult['STEPS'][] = array(
                'ID' => intval($step['ID']),
                'STEP_NUMBER' => htmlspecialcharsbx($step['PROPERTY_STEP_NUMBER_VALUE']),
                'TITLE' => htmlspecialcharsbx($step['PROPERTY_TITLE_VALUE']),
                'DESCRIPTION' => htmlspecialcharsbx($step['PROPERTY_DESCRIPTION_VALUE']),
            );
        }

        $this->arResult = $arResult;
    }

    /**
     * Получение этапов работы из инфоблока
     * @return array
     */
    protected function getApproachSteps()
    {
        $res = ElementTable::getList(array(
            'filter' => array(
                '=IBLOCK_CODE' => self::CODE_IBLOCK,
                'ACTIVE' => 'Y',
                '=IBLOCK_LID' => SITE_ID,
            ),
            'select' => array(
                'ID',
                'NAME',
                'PROPERTY_STEP_NUMBER',
                'PROPERTY_TITLE',
                'PROPERTY_DESCRIPTION',
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
?>
