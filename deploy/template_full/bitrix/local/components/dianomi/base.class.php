<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Iblock\IblockTable;

/**
 * Базовый класс для всех компонентов Dianomi
 * Содержит общие методы для работы с инфоблоками
 */
abstract class CBitrixComponentDianomiBase extends CBitrixComponent
{
    /**
     * @var array Кэш ID инфоблоков
     */
    protected $iblockIDCache = null;

    /**
     * Получить ID инфоблока по коду
     * @param string $iblockCode Код инфоблока
     * @return int ID инфоблока
     */
    protected function getIblockID($iblockCode)
    {
        if ($this->iblockIDCache === null || !isset($this->iblockIDCache[$iblockCode])) {
            $res = IblockTable::getList(array(
                'filter' => array(
                    '=CODE' => $iblockCode,
                    'SITE_ID' => SITE_ID,
                ),
                'select' => array('ID'),
                'limit' => 1,
            ));

            $row = $res->fetch();
            $this->iblockIDCache[$iblockCode] = $row ? intval($row['ID']) : 0;
        }

        return $this->iblockIDCache[$iblockCode];
    }

    /**
     * Проверка прав доступа (по умолчанию все доступны для чтения)
     * @return bool
     */
    protected function checkRights()
    {
        return true;
    }

    /**
     * Проверка существования инфоблока
     * @param string $iblockCode Код инфоблока
     * @return bool
     */
    protected function checkIblockExists($iblockCode)
    {
        return $this->getIblockID($iblockCode) > 0;
    }

    /**
     * Аборт выполнения, если инфоблок не найден
     * @param string $iblockCode Код инфоблока
     * @return bool
     */
    protected function abortOnEmptyIblock($iblockCode)
    {
        if (!$this->checkIblockExists($iblockCode)) {
            $this->abortStep();
            return false;
        }
        return true;
    }

    /**
     * Получить код инфоблока (абстрактный метод)
     * @return string
     */
    abstract protected function getIblockCode();
}
?>
