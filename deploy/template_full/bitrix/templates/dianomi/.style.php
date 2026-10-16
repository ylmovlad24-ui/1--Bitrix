<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arTemplateSettings = array(
    "PAGES" => array(
        "SECTION_PAGE" => array(
            "NAME" => GetMessage("TEMPLATE_SECTION_PAGE"),
            "DEFAULT" => "Y",
            "TYPE" => "CHECKBOX",
        ),
        "MAIN_PAGE" => array(
            "NAME" => GetMessage("TEMPLATE_MAIN_PAGE"),
            "DEFAULT" => "Y",
            "TYPE" => "CHECKBOX",
        ),
    ),
);
?>
