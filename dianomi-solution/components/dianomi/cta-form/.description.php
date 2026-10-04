<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_CTA_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_CTA_DESCR"),
    'ICON' => '/images/cta.gif',
    'SORT' => 80,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
