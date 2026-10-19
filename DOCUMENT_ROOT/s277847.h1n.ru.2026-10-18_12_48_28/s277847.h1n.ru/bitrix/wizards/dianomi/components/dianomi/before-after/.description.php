<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_BEFORE_AFTER_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_BEFORE_AFTER_DESCR"),
    'ICON' => '/images/before_after.gif',
    'SORT' => 50,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
