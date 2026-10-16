<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arTemplate = array(
    "NAME" => GetMessage("TEMPLATE_NAME"),
    "DESCRIPTION" => GetMessage("TEMPLATE_DESCRIPTION"),
    "SORT" => 10,
    "TYPE" => "main",
    "PATH" => array(
        "ID" => "site",
        "NAME" => GetMessage("TEMPLATE_CATALOG"),
    ),
);
?>
