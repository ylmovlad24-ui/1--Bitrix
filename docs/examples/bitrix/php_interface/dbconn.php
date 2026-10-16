<?php
/**
 * Database connection for Multi-Site Bitrix
 * 
 * This file handles database connections for multi-site setup.
 * Each site can use its own database or share one.
 * 
 * Location: bitrix/php_interface/dbconn.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Detect current site
$currentSite = '';
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$paths = explode('/', trim($docRoot, '/'));
if (count($paths) > 1) {
    $currentSite = end($paths);
}

// Site-specific database configurations
$databases = [
    'dianomi' => [
        'host' => 'localhost',
        'user' => 'site_ru_dianomi',
        'password' => 'dianomi_password_here',
        'database' => 'site_ru_dianomi',
        'tablePrefix' => 'b_',
    ],
    'shop' => [
        'host' => 'localhost',
        'user' => 'site_ru_shop',
        'password' => 'shop_password_here',
        'database' => 'site_ru_shop',
        'tablePrefix' => 'b_',
    ],
    'blog' => [
        'host' => 'localhost',
        'user' => 'site_ru_blog',
        'password' => 'blog_password_here',
        'database' => 'site_ru_blog',
        'tablePrefix' => 'b_',
    ],
    'default' => [
        'host' => 'localhost',
        'user' => 'site_ru_default',
        'password' => 'default_password_here',
        'database' => 'site_ru_default',
        'tablePrefix' => 'b_',
    ],
];

// Use site-specific database or default
$dbConfig = $databases[$currentSite] ?? $databases['default'];

// Try to load site-specific dbconn.php if exists
$siteDbConn = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/dbconn.' . $currentSite . '.php';
if (file_exists($siteDbConn)) {
    return include_once($siteDbConn);
}

// Standard Bitrix database connection
global $DB;

$DB->Connect(
    $dbConfig['host'],
    $dbConfig['user'],
    $dbConfig['password'],
    $dbConfig['database']
);

// Define constants for Bitrix
define("DB_HOST", $dbConfig['host']);
define("DB_USER", $dbConfig['user']);
define("DB_PASSWORD", $dbConfig['password']);
define("DB_NAME", $dbConfig['database']);
define("DB_TABLE_PREFIX", $dbConfig['tablePrefix']);

// Common database settings
define("DB_TYPE", "MYSQL");
define("DB_DELAY", 0);
define("DB_KEEPALIVE", 0);

/**
 * Helper function to get current site database config
 */
if (!function_exists('getCurrentSiteDbConfig')) {
    function getCurrentSiteDbConfig() {
        global $currentSite;
        static $config = null;
        
        if ($config === null) {
            $databases = [
                'dianomi' => [
                    'host' => 'localhost',
                    'user' => 'site_ru_dianomi',
                    'password' => 'dianomi_password_here',
                    'database' => 'site_ru_dianomi',
                    'tablePrefix' => 'b_',
                ],
                'default' => [
                    'host' => 'localhost',
                    'user' => 'site_ru_default',
                    'password' => 'default_password_here',
                    'database' => 'site_ru_default',
                    'tablePrefix' => 'b_',
                ],
            ];
            
            $config = $databases[$currentSite] ?? $databases['default'];
        }
        
        return $config;
    }
}
