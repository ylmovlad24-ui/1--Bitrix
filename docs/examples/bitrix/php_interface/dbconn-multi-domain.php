<?php
/**
 * Database connection for Multi-Site (Different Domains)
 * 
 * This file is shared across ALL sites in the multi-site setup.
 * All sites use ONE database.
 * 
 * Location: /var/www/shared/bitrix/php_interface/dbconn.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Database settings for multi-site setup
// ALL sites share the same database
define("DB_HOST", "localhost");
define("DB_USER", "site_ru_user");
define("DB_PASSWORD", "secure_password_here");
define("DB_NAME", "site_ru_db");
define("DB_TABLE_PREFIX", "b_");

// Connect to database
global $DB;

$DB->Connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Database settings
define("DB_TYPE", "MYSQL");
define("DB_DELAY", 0);
define("DB_KEEPALIVE", 0);

/**
 * Helper function to get current site code based on domain
 */
if (!function_exists('getCurrentSiteCode')) {
    function getCurrentSiteCode() {
        static $siteCode = null;
        
        if ($siteCode === null) {
            $domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
            
            switch ($domain) {
                case 'dianomi.ru':
                case 'www.dianomi.ru':
                    $siteCode = 'dianomi';
                    break;
                case 'shop.ru':
                case 'www.shop.ru':
                    $siteCode = 'shop';
                    break;
                case 'blog.ru':
                case 'www.blog.ru':
                    $siteCode = 'blog';
                    break;
                default:
                    $siteCode = 'default';
                    break;
            }
        }
        
        return $siteCode;
    }
}

/**
 * Helper function to get site-specific settings
 */
if (!function_exists('getSiteSetting')) {
    function getSiteSetting($key, $default = null) {
        $siteCode = getCurrentSiteCode();
        
        // Example: Get site-specific setting from database
        // $db = new CDatabase();
        // $rs = $db->Query("SELECT * FROM b_module_message WHERE SITE_ID = '{$siteCode}'");
        
        return $default;
    }
}
