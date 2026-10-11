<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

return array(
    'NAME' => Loc::getMessage("DIANOMI_HERO_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_HERO_DESCR"),
    'ICON' => '/images/hero.gif',
    'SORT' => 10,
    'PATH' => array(
        'NAME' => 'Dianomi',
        'FILE' => '',
    ),
);
