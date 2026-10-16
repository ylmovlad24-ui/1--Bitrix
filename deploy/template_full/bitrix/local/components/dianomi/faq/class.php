<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

Loc::loadMessages(__FILE__);

/**
 * Компонент FAQ Section
 * Выводит часто задаваемые вопросы (аккордеон)
 */
class CBitrixComponentDianomiFaq extends CBitrixComponentDianomiBase
{
    const CODE_IBLOCK = 'page_faq';

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

        // Получение списка FAQ
        $arFaqs = $this->getFaqList();

        if (empty($arFaqs)) {
            $this->abortStep();
            return;
        }

        // Подготовка данных для шаблона
        // ANSWER не экранируется, так как это HTML-контент
        foreach ($arFaqs as $faq) {
            $arResult['FAQ'][] = array(
                'ID' => intval($faq['ID']),
                'QUESTION' => htmlspecialcharsbx($faq['PROPERTY_QUESTION_VALUE']),
                'ANSWER' => $faq['PROPERTY_ANSWER_VALUE'], // HTML-контент, не экранировать
            );
        }

        $this->arResult = $arResult;
    }

    /**
     * Получение списка FAQ из инфоблока
     * @return array
     */
    protected function getFaqList()
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
                'PROPERTY_QUESTION',
                'PROPERTY_ANSWER',
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
