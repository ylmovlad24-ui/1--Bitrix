<?php
/**
 * Global initialization for Multi-Site Bitrix
 * 
 * This file is loaded for ALL sites in the multi-site setup.
 * Use $APPLICATION->GetServerUniqcode() to detect current site
 * and apply site-specific logic if needed.
 * 
 * Location: bitrix/php_interface/init.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Detect current site folder
$currentSite = '';
if (isset($_SERVER['DOCUMENT_ROOT'])) {
    $docRoot = $_SERVER['DOCUMENT_ROOT'];
    // Extract site name from document root
    // Example: /var/www/site.ru/dianomi -> dianomi
    $paths = explode('/', trim($docRoot, '/'));
    if (count($paths) > 1) {
        $currentSite = end($paths);
    }
}

// Site-specific initialization
switch ($currentSite) {
    case 'dianomi':
        // Dianomi site specific settings
        define('DIANOMI_SITE', true);
        define('CURRENT_SITE_CODE', 'dianomi');
        break;
        
    case 'shop':
        // Shop site specific settings
        define('SHOP_SITE', true);
        define('CURRENT_SITE_CODE', 'shop');
        break;
        
    case 'blog':
        // Blog site specific settings
        define('BLOG_SITE', true);
        define('CURRENT_SITE_CODE', 'blog');
        break;
        
    default:
        // Default site settings
        define('CURRENT_SITE_CODE', 'default');
        break;
}

// Common event handlers for all sites
$Events = GetModuleEvents("main");

// Example: Log all errors (common for all sites)
$Event = new CEvent();
AddEventHandler("main", "BeforeProlog", function() {
    // Common initialization code
});

// Example: Add common header scripts
AddEventHandler("main", "CheckDemosEnd", function() {
    // Common demo settings
});

// Include common utilities
if (file_exists(__DIR__ . '/utilities.php')) {
    include_once(__DIR__ . '/utilities.php');
}

// Include site-specific init if exists
$siteInitPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/' . $currentSite . '.init.php';
if (file_exists($siteInitPath)) {
    include_once($siteInitPath);
}

// Global settings
define('SITE_NAME', 'Multi-Site');
define('SITE_VERSION', '1.0.0');
