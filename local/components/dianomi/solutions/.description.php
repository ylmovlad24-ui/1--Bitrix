<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => "Solutions Section (Dianomi)",
    "DESCRIPTION" => "Отображает секцию с решениями и направлениями работ",
    "ICON" => "/images/solutions_icon.gif",
    "SORT" => 30,
    "PATH" => array(
        "ID" => "dianomi",
        "NAME" => "Dianomi Components",
        "SORT" => 10,
        "PAGE" => "index.php",
    ),
);
