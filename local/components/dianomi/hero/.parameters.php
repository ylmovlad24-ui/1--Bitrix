<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "PAGE_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => "Код страницы (PAGE_CODE)",
            "TYPE" => "STRING",
            "DEFAULT" => "index",
            "VALUES" => array(
                "index" => "Главная",
                "about" => "О компании",
                "contacts" => "Контакты",
                "business-systems" => "Бизнес-системы",
                "bitrix24" => "Битрикс24",
                "web-systems" => "Веб-системы",
                "1c-bitrix" => "1С-Битрикс",
                "data-bi" => "Данные и BI",
            ),
        ),
    ),
);
