<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_APPROACH_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_APPROACH_DESCR"),
    'ICON' => '/images/approach.gif',
    'SORT' => 60,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
