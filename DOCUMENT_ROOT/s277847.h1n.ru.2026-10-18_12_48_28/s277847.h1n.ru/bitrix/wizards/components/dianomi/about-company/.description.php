<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_ABOUT_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_ABOUT_DESCR"),
    'ICON' => '/images/about.gif',
    'SORT' => 70,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
