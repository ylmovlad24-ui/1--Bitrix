<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentRequirements = array(
    "RIGHTS" => "D",
    "IBLOCK" => array(
        "page_solutions",
    ),
);

$arComponentParameters = array(
    "PARAMETERS" => array(),
    "CACHE_SETTINGS" => array(
        "DEFAULT" => array(),
    ),
);
