<?php
/**
 * Common Utilities for Multi-Site Bitrix
 * 
 * Shared helper functions for all sites
 * 
 * Location: bitrix/php_interface/utilities.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Get current site code
 * @return string
 */
function getCurrentSiteCode() {
    static $siteCode = null;
    
    if ($siteCode === null) {
        $docRoot = $_SERVER['DOCUMENT_ROOT'];
        $paths = explode('/', trim($docRoot, '/'));
        $siteCode = (count($paths) > 1) ? end($paths) : 'default';
    }
    
    return $siteCode;
}

/**
 * Get site-specific path
 * @param string $relativePath
 * @return string
 */
function getSitePath($relativePath = '') {
    $siteCode = getCurrentSiteCode();
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $siteCode . '/' . $relativePath;
}

/**
 * Check if current site is a specific site
 * @param string $siteCode
 * @return bool
 */
function isSite($siteCode) {
    return getCurrentSiteCode() === $siteCode;
}

/**
 * Get all configured sites
 * @return array
 */
function getAllSites() {
    return [
        'dianomi' => [
            'code' => 'dianomi',
            'name' => 'Dianomi Site',
            'folder' => '/dianomi/',
            'active' => true,
        ],
        'shop' => [
            'code' => 'shop',
            'name' => 'Shop Site',
            'folder' => '/shop/',
            'active' => true,
        ],
        'blog' => [
            'code' => 'blog',
            'name' => 'Blog Site',
            'folder' => '/blog/',
            'active' => true,
        ],
    ];
}

/**
 * Get site configuration
 * @param string $siteCode
 * @return array|null
 */
function getSiteConfig($siteCode) {
    $sites = getAllSites();
    return $sites[$siteCode] ?? null;
}

/**
 * Load site-specific template
 * @param string $templateName
 * @param array $vars
 */
function includeSiteTemplate($templateName, $vars = []) {
    $siteCode = getCurrentSiteCode();
    $templatePath = getSitePath("bitrix/templates/{$siteCode}/{$templateName}.php");
    
    if (file_exists($templatePath)) {
        extract($vars);
        include($templatePath);
    } else {
        // Fallback to default template
        $defaultPath = getSitePath("bitrix/templates/default/{$templateName}.php");
        if (file_exists($defaultPath)) {
            extract($vars);
            include($defaultPath);
        }
    }
}

/**
 * Get site-specific component path
 * @param string $componentName
 * @param string $filePath
 * @return string
 */
function getSiteComponentPath($componentName, $filePath = '') {
    $siteCode = getCurrentSiteCode();
    return getSitePath("bitrix/components/{$siteCode}/{$componentName}/{$filePath}");
}

/**
 * Check if file exists in site-specific location
 * @param string $relativePath
 * @return bool
 */
function siteFileExists($relativePath) {
    return file_exists(getSitePath($relativePath));
}

/**
 * Get site-specific URL
 * @param string $path
 * @return string
 */
function getSiteUrl($path = '') {
    $siteCode = getCurrentSiteCode();
    $domain = 'http://site.ru'; // Replace with actual domain
    
    if ($siteCode === 'default') {
        return $domain . '/' . $path;
    }
    
    return $domain . $siteCode . '/' . $path;
}

/**
 * Log site-specific error
 * @param string $message
 * @param string $siteCode
 */
function siteLogError($message, $siteCode = null) {
    if ($siteCode === null) {
        $siteCode = getCurrentSiteCode();
    }
    
    $logPath = $_SERVER['DOCUMENT_ROOT'] . '/logs/site_' . $siteCode . '_errors.log';
    $logDir = dirname($logPath);
    
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message" . PHP_EOL;
    
    file_put_contents($logPath, $logMessage, FILE_APPEND);
}

/**
 * Get site-specific settings from database
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function getSiteSetting($key, $default = null) {
    $siteCode = getCurrentSiteCode();
    
    // Try to get from cache first
    $cacheKey = 'site_setting_' . $siteCode . '_' . $key;
    
    // Bitrix cache implementation would go here
    // For now, return default
    return $default;
}

/**
 * Set site-specific setting
 * @param string $key
 * @param mixed $value
 */
function setSiteSetting($key, $value) {
    $siteCode = getCurrentSiteCode();
    
    // Implementation for saving settings to database
    // Bitrix implementation would go here
}
