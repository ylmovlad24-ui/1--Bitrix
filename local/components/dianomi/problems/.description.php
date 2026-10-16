<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => "Problems Section (Dianomi)",
    "DESCRIPTION" => "Отображает секцию с проблемами клиентов",
    "ICON" => "/images/problems_icon.gif",
    "SORT" => 20,
    "PATH" => array(
        "ID" => "dianomi",
        "NAME" => "Dianomi Components",
        "SORT" => 10,
        "PAGE" => "index.php",
    ),
);
