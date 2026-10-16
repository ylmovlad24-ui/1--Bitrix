<?php
/**
 * Template Description for New Bitrix Site
 * 
 * Location: template-site/bitrix/templates/{site_name}/.description.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$templateTitle = isset($TEMPLATE_NAME) ? $TEMPLATE_NAME : mb_strtolower(mb_trim($TEMPLATE_THEME));
$templateName = isset($TEMPLATE_TITLE) ? $TEMPLATE_TITLE : $templateTitle;

return [
    'ID' => $template_theme ?? 'dianomi',
    'NAME' => 'Template for ' . getCurrentSiteCode(),
    'DESCRIPTION' => 'Custom template for multi-site Bitrix setup',
    'VERSION' => [
        'NAME' => '1.0.0',
        'SYMBOL' => 'v1.0.0',
    ],
    'Parent' => [
        'ADAPTIVE' => 'Y',
        'COLOR_VARIABLE' => '',
        'FONT_SIZE' => 's',
        'SCREEN_RADIO' => 'm',
        'THEME' => 'default',
    ],
    'SORT' => 100,
    'TYPES' => [
        'index',
        'about',
        'contacts',
        'catalog',
        'detail',
        'list',
    ],
    'COMPONENT' => [
        'NAME' => '',
        'ID' => '',
    ],
    'PARAMETERS' => [
        'GRID_SIDEBAR_POSITION' => [
            'PADENTS' => 'N',
            'PARENT' => 'PHYSICAL",
            'TITLE' => 'Положение боковой колонки',
            'TYPE' => 'SELECT',
            'VALUES' => [
                'LEFT' => 'Слева',
                'RIGHT' => 'Справа',
            ],
            'DEFAULT' => 'LEFT',
            'MULTIPLE' => 'N',
            'REFRESH' => 'N',
        ],
        'GRID_SIDEBAR_WIDTH' => [
            'PADENTS' => 'N',
            'PARENT' => 'PHYSICAL",
            'TITLE' => 'Ширина боковой колонки',
            'TYPE' => 'SELECT',
            'VALUES' => [
                '240' => '240px',
                '300' => '300px',
                '360' => '360px',
            ],
            'DEFAULT' => '240',
            'REFRESH' => 'N',
        ],
    ],
    'FILES' => [
        'footer.php' => [
            'NAME' => 'footer',
            'SORT' => '10',
        ],
        'header.php' => [
            'NAME' => 'header',
            'SORT' => '20',
        ],
    ],
];
