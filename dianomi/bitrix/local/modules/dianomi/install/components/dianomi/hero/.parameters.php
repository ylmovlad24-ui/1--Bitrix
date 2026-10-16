<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
            "NAME" => "Код страницы",
            "TYPE" => "STRING",
            "DEFAULT" => "index",
            "REFS" => array(
                "index" => "Главная",
                "about" => "О компании",
                "contacts" => "Контакты",
                "business-systems" => "Системы управления",
            ),
        ),
    ),
);
