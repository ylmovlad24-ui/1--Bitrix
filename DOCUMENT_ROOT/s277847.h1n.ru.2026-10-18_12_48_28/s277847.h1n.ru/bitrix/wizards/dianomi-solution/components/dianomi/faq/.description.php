<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return array(
    'NAME' => Loc::getMessage("DIANOMI_FAQ_NAME"),
    'DESCRIPTION' => Loc::getMessage("DIANOMI_FAQ_DESCR"),
    'ICON' => '/images/faq.gif',
    'SORT' => 40,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
