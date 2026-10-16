#!/usr/bin/env php
<?php
/**
 * Script to configure Bitrix admin for multi-site setup
 * 
 * This script creates configuration files for Bitrix admin
 * to recognize and manage multiple sites.
 * 
 * Usage:
 *   php scripts/configure-bitrix-admin.php
 * 
 * Location: scripts/configure-bitrix-admin.php
 */

$projectRoot = dirname(__DIR__);

echo "========================================\n";
echo "Configuring Bitrix Admin for Multi-Site\n";
echo "========================================\n\n";

// Step 1: Create sites configuration array
echo "[1/3] Creating sites configuration...\n";
createSitesConfig($projectRoot);

// Step 2: Create database setup script
echo "[2/3] Creating database setup script...\n";
createDatabaseSetup($projectRoot);

// Step 3: Create deployment configuration
echo "[3/3] Creating deployment configuration...\n";
createDeploymentConfig($projectRoot);

echo "\n========================================\n";
echo "Configuration complete!\n";
echo "========================================\n\n";

echo "Next steps:\n";
echo "1. Import sites configuration into Bitrix database\n";
echo "2. Run database setup for each site\n";
echo "3. Verify sites in Bitrix Admin\n\n";

exit(0);

/**
 * Create sites configuration
 */
function createSitesConfig($projectRoot) {
    $configPath = $projectRoot . '/docs/examples/sites-config.php';
    $config = "<?php\n" .
              "/**\n" .
              " * Multi-Site Configuration for Bitrix\n" .
              " * \n" .
              " * This file contains configuration for all sites\n" .
              " * Use this to import site settings into Bitrix database\n" .
              " * \n" .
              " * Location: docs/examples/sites-config.php\n" .
              " */\n\n" .
              "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
              "\$sites = [\n\n" .
              "    // Site 1: Dianomi\n" .
              "    [\n" .
              "        'ACTIVE' => 'Y',\n" .
              "        'SORT' => 100,\n" .
              "        'CODE' => 'dianomi',\n" .
              "        'NAME' => 'Dianomi Site',\n" .
              "        'SITE_DIR' => '/dianomi/',\n" .
              "        'DOMAIN' => 'site.ru',\n" .
              "        'TEMPLATE' => 'dianomi',\n" .
              "        'DEFAULT' => 'Y',\n" .
              "        'DIR' => 'Y',\n" .
              "        'LANG' => [\n" .
              "            [\n" .
              "                'LANG' => 'ru',\n" .
              "                'NAME' => 'Русский',\n" .
              "                'DOMAIN' => 'site.ru',\n" .
              "            ],\n" .
              "            [\n" .
              "                'LANG' => 'en',\n" .
              "                'NAME' => 'English',\n" .
              "                'DOMAIN' => 'site.ru',\n" .
              "            ],\n" .
              "        ],\n" .
              "    ],\n\n" .
              "    // Site 2: Shop\n" .
              "    [\n" .
              "        'ACTIVE' => 'Y',\n" .
              "        'SORT' => 200,\n" .
              "        'CODE' => 'shop',\n" .
              "        'NAME' => 'Shop Site',\n" .
              "        'SITE_DIR' => '/shop/',\n" .
              "        'DOMAIN' => 'site.ru',\n" .
              "        'TEMPLATE' => 'shop_template',\n" .
              "        'DEFAULT' => 'N',\n" .
              "        'DIR' => 'Y',\n" .
              "        'LANG' => [\n" .
              "            [\n" .
              "                'LANG' => 'ru',\n" .
              "                'NAME' => 'Русский',\n" .
              "                'DOMAIN' => 'site.ru',\n" .
              "            ],\n" .
              "        ],\n" .
              "    ],\n\n" .
              "    // Site 3: Blog\n" .
              "    [\n" .
              "        'ACTIVE' => 'Y',\n" .
              "        'SORT' => 300,\n" .
              "        'CODE' => 'blog',\n" .
              "        'NAME' => 'Blog Site',\n" .
              "        'SITE_DIR' => '/blog/',\n" .
              "        'DOMAIN' => 'site.ru',\n" .
              "        'TEMPLATE' => 'blog_template',\n" .
              "        'DEFAULT' => 'N',\n" .
              "        'DIR' => 'Y',\n" .
              "        'LANG' => [\n" .
              "            [\n" .
              "                'LANG' => 'ru',\n" .
              "                'NAME' => 'Русский',\n" .
              "                'DOMAIN' => 'site.ru',\n" .
              "            ],\n" .
              "        ],\n" .
              "    ],\n\n" .
              "];\n\n" .
              "return \$sites;\n";
    
    file_put_contents($configPath, $config);
    echo "  Created sites configuration\n";
}

/**
 * Create database setup script
 */
function createDatabaseSetup($projectRoot) {
    $setupPath = $projectRoot . '/docs/examples/setup-databases.sql';
    $sql = "--\n" .
           "-- Database Setup for Multi-Site Bitrix\n" .
           "-- \n" .
           "-- This script creates databases for each site\n" .
           "-- Run with: mysql -u root -p < setup-databases.sql\n" .
           "--\n\n" .
           "-- Create database for Dianomi site\n" .
           "CREATE DATABASE IF NOT EXISTS `site_ru_dianomi` \n" .
           "CHARACTER SET utf8mb4 \n" .
           "COLLATE utf8mb4_unicode_ci;\n\n" .
           "-- Create database for Shop site\n" .
           "CREATE DATABASE IF NOT EXISTS `site_ru_shop` \n" .
           "CHARACTER SET utf8mb4 \n" .
           "COLLATE utf8mb4_unicode_ci;\n\n" .
           "-- Create database for Blog site\n" .
           "CREATE DATABASE IF NOT EXISTS `site_ru_blog` \n" .
           "CHARACTER SET utf8mb4 \n" .
           "COLLATE utf8mb4_unicode_ci;\n\n" .
           "-- Create users for each database\n" .
           "CREATE USER IF NOT EXISTS 'site_ru_dianomi'@'localhost' IDENTIFIED BY 'dianomi_secure_password';\n" .
           "CREATE USER IF NOT EXISTS 'site_ru_shop'@'localhost' IDENTIFIED BY 'shop_secure_password';\n" .
           "CREATE USER IF NOT EXISTS 'site_ru_blog'@'localhost' IDENTIFIED BY 'blog_secure_password';\n\n" .
           "-- Grant privileges\n" .
           "GRANT ALL PRIVILEGES ON `site_ru_dianomi`.* TO 'site_ru_dianomi'@'localhost';\n" .
           "GRANT ALL PRIVILEGES ON `site_ru_shop`.* TO 'site_ru_shop'@'localhost';\n" .
           "GRANT ALL PRIVILEGES ON `site_ru_blog`.* TO 'site_ru_blog'@'localhost';\n\n" .
           "FLUSH PRIVILEGES;\n\n";
    
    file_put_contents($setupPath, $sql);
    echo "  Created database setup script\n";
}

/**
 * Create deployment configuration
 */
function createDeploymentConfig($projectRoot) {
    $deployPath = $projectRoot . '/docs/examples/DEPLOYMENT-CHECKLIST.md';
    $checklist = "# Multi-Site Deployment Checklist\n\n" .
                 "## Pre-Deployment\n\n" .
                 "- [ ] Server configured with Apache/Nginx\n" .
                 "- [ ] PHP 7.4+ installed with required extensions\n" .
                 "- [ ] MySQL 5.7+ installed\n" .
                 "- [ ] Domain pointed to server\n" .
                 "- [ ] SSL certificates installed (optional but recommended)\n\n" .
                 "## Database Setup\n\n" .
                 "- [ ] Run `setup-databases.sql` to create databases\n" .
                 "- [ ] Verify database connections\n" .
                 "- [ ] Test database user permissions\n\n" .
                 "## File Structure\n\n" .
                 "- [ ] Upload Bitrix core to `/var/www/site.ru/bitrix/`\n" .
                 "- [ ] Create site folders (dianomi, shop, blog)\n" .
                 "- [ ] Set correct permissions (755 for dirs, 644 for files)\n" .
                 "- [ ] Upload site-specific files to each folder\n\n" .
                 "## Configuration\n\n" .
                 "- [ ] Configure `bitrix/php_interface/dbconn.php`\n" .
                 "- [ ] Configure site-specific `dbconn.{site}.php`\n" .
                 "- [ ] Configure `bitrix/php_interface/init.php`\n" .
                 "- [ ] Set up site-specific `init.{site}.php` files\n\n" .
                 "## Bitrix Admin Setup\n\n" .
                 "- [ ] Install Bitrix framework (if not installed)\n" .
                 "- [ ] Go to Settings → Site Management\n" .
                 "- [ ] Add site: dianomi\n" .
                 "  - Domain: site.ru\n" .
                 "  - Folder: /dianomi/\n" .
                 "  - Template: dianomi\n" .
                 "- [ ] Add site: shop\n" .
                 "  - Domain: site.ru\n" .
                 "  - Folder: /shop/\n" .
                 "  - Template: shop_template\n" .
                 "- [ ] Add site: blog\n" .
                 "  - Domain: site.ru\n" .
                 "  - Folder: /blog/\n" .
                 "  - Template: blog_template\n" .
                 "- [ ] Set up site order and priorities\n\n" .
                 "## Testing\n\n" .
                 "- [ ] Test each site loads correctly\n" .
                 "- [ ] Verify database connections\n" .
                 "- [ ] Test admin panel access for each site\n" .
                 "- [ ] Check template rendering\n" .
                 "- [ ] Test form submissions\n" .
                 "- [ ] Verify caching works\n" .
                 "- [ ] Test mobile responsiveness\n\n" .
                 "## Security\n\n" .
                 "- [ ] Set strong database passwords\n" .
                 "- [ ] Configure firewall rules\n" .
                 "- [ ] Enable SSL/HTTPS\n" .
                 "- [ ] Set up regular backups\n" .
                 "- [ ] Configure error logging\n" .
                 "- [ ] Test file permissions\n\n" .
                 "## Performance\n\n" .
                 "- [ ] Enable OPcache\n" .
                 "- [ ] Configure PHP memory limit\n" .
                 "- [ ] Enable Bitrix caching\n" .
                 "- [ ] Configure static file caching\n" .
                 "- [ ] Optimize images\n" .
                 "- [ ] Test page load times\n\n" .
                 "## Post-Deployment\n\n" .
                 "- [ ] Monitor error logs\n" .
                 "- [ ] Check analytics tracking\n" .
                 "- [ ] Verify SEO settings\n" .
                 "- [ ] Test backup process\n" .
                 "- [ ] Document any custom configurations\n\n";
    
    file_put_contents($deployPath, $checklist);
    echo "  Created deployment checklist\n";
}
