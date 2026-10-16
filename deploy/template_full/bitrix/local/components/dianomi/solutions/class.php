<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

/**
 * Компонент Solutions Section
 * Выводит карточки решений/направлений
 */
class CBitrixComponentDianomiSolutions extends CBitrixComponentDianomiBase
{
    const CODE_IBLOCK = 'page_solutions';

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

        // Получение списка решений
        $arSolutions = $this->getSolutionsList();

        if (empty($arSolutions)) {
            $this->abortStep();
            return;
        }

        // Подготовка данных для шаблона
        // ВАЖНО: ICON не экранируется, так как это HTML-код иконки
        foreach ($arSolutions as $solution) {
            $arResult['SOLUTIONS'][] = array(
                'ID' => intval($solution['ID']),
                'ICON' => $solution['PROPERTY_ICON_VALUE'], // HTML-код иконки, не экранировать
                'TITLE' => htmlspecialcharsbx($solution['PROPERTY_TITLE_VALUE']),
                'DESCRIPTION' => htmlspecialcharsbx($solution['PROPERTY_DESCRIPTION_VALUE']),
                'BENEFITS' => $solution['PROPERTY_BENEFITS_VALUE'],
                'LINK_TEXT' => htmlspecialcharsbx($solution['PROPERTY_LINK_TEXT_VALUE']),
                'LINK_URL' => htmlspecialcharsbx($solution['PROPERTY_LINK_URL_VALUE']),
                'BORDER_COLOR' => htmlspecialcharsbx($solution['PROPERTY_BORDER_COLOR_VALUE']),
            );
        }

        $this->arResult = $arResult;
    }

    /**
     * Получение списка решений из инфоблока
     * @return array
     */
    protected function getSolutionsList()
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
                'PROPERTY_BENEFITS',
                'PROPERTY_LINK_TEXT',
                'PROPERTY_LINK_URL',
                'PROPERTY_BORDER_COLOR',
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
