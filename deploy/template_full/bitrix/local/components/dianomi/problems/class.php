<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

/**
 * Компонент Problems Section
 * Выводит карточки проблем клиентов
 */
class CBitrixComponentDianomiProblems extends CBitrixComponentDianomiBase
{
    const CODE_IBLOCK = 'page_problems';

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

        // Получение списка проблем
        $arProblems = $this->getProblemsList();

        if (empty($arProblems)) {
            $this->abortStep();
            return;
        }

        // Подготовка данных для шаблона
        // ВАЖНО: ICON не экранируется, так как это HTML-код иконки
        foreach ($arProblems as $problem) {
            $arResult['PROBLEMS'][] = array(
                'ID' => intval($problem['ID']),
                'ICON' => $problem['PROPERTY_ICON_VALUE'], // HTML-код иконки, не экранировать
                'TITLE' => htmlspecialcharsbx($problem['PROPERTY_TITLE_VALUE']),
                'DESCRIPTION' => htmlspecialcharsbx($problem['PROPERTY_DESCRIPTION_VALUE']),
            );
        }

        $this->arResult = $arResult;
    }

    /**
     * Получение списка проблем из инфоблока
     * @return array
     */
    protected function getProblemsList()
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
                'PROPERTY_ICON',
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
