<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

return array(
    'NAME' => 'Hero Section',
    'DESCRIPTION' => 'Hero-секция с заголовком и счётчиками',
    'DESCRIPTION_CODE' => 'Компонент выводит hero-секцию страницы',
    'ICON' => '/images/hero_icon.gif',
    'SORT' => 10,
    'PATH' => array(
        'TEMPLATE' => 'templates/.default',
    ),
);
