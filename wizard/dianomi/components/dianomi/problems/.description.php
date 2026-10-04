<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_PROBLEMS_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_PROBLEMS_DESCR"),
    'ICON' => '/images/problems.gif',
    'SORT' => 20,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
