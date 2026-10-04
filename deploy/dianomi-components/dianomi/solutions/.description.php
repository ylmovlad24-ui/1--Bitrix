<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_SOLUTIONS_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_SOLUTIONS_DESCR"),
    'ICON' => '/images/solutions.gif',
    'SORT' => 30,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
