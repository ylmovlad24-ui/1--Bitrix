<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentRequirements = array(
    "RIGHTS" => "D",
    "IBLOCK" => array(
        "page_hero",
    ),
);

$arComponentParameters = array(
    "PARAMETERS" => array(
        "PAGE_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("DIANOMI_HERO_PAGE_CODE"),
            "TYPE" => "STRING",
            "DEFAULT" => "index",
            "REFS" => array(
                "index" => Loc::getMessage("DIANOMI_HERO_PAGE_CODE_INDEX"),
                "about" => Loc::getMessage("DIANOMI_HERO_PAGE_CODE_ABOUT"),
                "contacts" => Loc::getMessage("DIANOMI_HERO_PAGE_CODE_CONTACTS"),
                "business-systems" => Loc::getMessage("DIANOMI_HERO_PAGE_CODE_BUSINESS"),
            ),
        ),
    ),
    "CACHE_SETTINGS" => array(
        "DEFAULT" => array(),
    ),
);
