#!/usr/bin/env php
<?php
/**
 * Script to initialize the first site (dianomi.ru)
 * 
 * This script prepares the first site for Bitrix installation
 * and creates all necessary configuration files.
 * 
 * Usage:
 *   php scripts/init-first-site.php
 * 
 * Location: scripts/init-first-site.php
 */

// Configuration
$baseDir = '/var/www';
$sharedDir = $baseDir . '/shared';
$firstSiteDir = $baseDir . '/site-dianomi';
$firstSiteDomain = 'dianomi.ru';
$firstSiteTitle = 'Dianomi Site';

echo "========================================\n";
echo "Initialize First Site - dianomi.ru\n";
echo "========================================\n\n";

// Step 1: Check directories
echo "[1/5] Checking directories...\n";
checkDirectories();

// Step 2: Create index.php
echo "[2/5] Creating index.php...\n";
createIndexFile();

// Step 3: Create .htaccess
echo "[3/5] Creating .htaccess...\n";
createHtaccess();

// Step 4: Create site template
echo "[4/5] Creating site template...\n";
createSiteTemplate();

// Step 5: Create Apache configuration
echo "[5/5] Creating Apache configuration...\n";
createApacheConfig();

echo "\n========================================\n";
echo "First site initialized!\n";
echo "========================================\n\n";

echo "✅ Site: dianomi.ru\n";
echo "   Directory: {$firstSiteDir}\n";
echo "   Template: dianomi\n\n";

echo "Next steps:\n";
echo "1. Install Bitrix in: {$firstSiteDir}\n";
echo "   - Open http://{$firstSiteDomain}/install/\n";
echo "   - Follow installation wizard\n";
echo "   - Use database: site_ru_db\n\n";

echo "2. After installation, run setup script:\n";
echo "   php scripts/setup-multi-domain.php\n\n";

echo "3. Add sites in Bitrix Admin:\n";
echo "   - Settings → Site Management → List of sites\n";
echo "   - Configure dianomi.ru\n";
echo "   - Add shop.ru, blog.ru\n\n";

exit(0);

/**
 * Check directories
 */
function checkDirectories() {
    global $firstSiteDir;
    
    if (!is_dir($firstSiteDir)) {
        if (!mkdir($firstSiteDir, 0755, true)) {
            exit("Error: Failed to create directory: {$firstSiteDir}\n");
        }
        echo "  Created: {$firstSiteDir}/\n";
    } else {
        echo "  Exists: {$firstSiteDir}/\n";
    }
}

/**
 * Create index.php
 */
function createIndexFile() {
    global $firstSiteDir, $firstSiteDomain, $firstSiteTitle;
    
    $indexPath = $firstSiteDir . '/index.php';
    
    if (file_exists($indexPath)) {
        echo "  Already exists: {$indexPath}\n";
        return;
    }
    
    $content = "<?php\n" .
              "/**\n" .
              " * Index page for {$firstSiteDomain}\n" .
              " * \n" .
              " * Part of multi-site setup with different domains\n" .
              " */\n\n" .
              "define(\"STOP_STATISTICS\", true);\n" .
              "define(\"NO_AGENT_STATISTICS\", true);\n" .
              "define(\"NO_AGENT_CHECK\", true);\n\n" .
              "require(\$_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_before.php\");\n\n" .
              "// Site-specific initialization\n" .
              "define('DIANOMI_SITE', true);\n" .
              "define('CURRENT_SITE_CODE', 'dianomi');\n\n" .
              "require(\$_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_after.php\");\n\n" .
              "?>\n" .
              "<!DOCTYPE html>\n" .
              "<html lang=\"ru\">\n" .
              "<head>\n" .
              "    <meta charset=\"UTF-8\">\n" .
              "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n" .
              "    <title><?php echo \$APPLICATION->getTitle(); ?></title>\n" .
              "    <meta name=\"description\" content=\"<?php echo \$APPLICATION->getMetaDataTags('description'); ?>\">\n" .
              "</head>\n" .
              "<body>\n" .
              "    <div class=\"site-wrapper\">\n" .
              "        <?php \$APPLICATION->showContent(); ?>\n" .
              "    </div>\n" .
              "</body>\n" .
              "</html>\n\n" .
              "<?php require(\$_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/epilog.php\"); ?>\n";
    
    file_put_contents($indexPath, $content);
    echo "  Created: {$indexPath}\n";
}

/**
 * Create .htaccess
 */
function createHtaccess() {
    global $firstSiteDir;
    
    $htaccessPath = $firstSiteDir . '/.htaccess';
    
    if (file_exists($htaccessPath)) {
        echo "  Already exists: {$htaccessPath}\n";
        return;
    }
    
    $content = "#\n" .
              "# HTAccess for dianomi.ru\n" .
              "# Part of multi-site setup\n" .
              "#\n\n" .
              "<IfModule mod_rewrite.c>\n" .
              "    RewriteEngine On\n" .
              "\n" .
              "    # Redirect to Bitrix\n" .
              "    RewriteCond %{REQUEST_FILENAME} !-f\n" .
              "    RewriteCond %{REQUEST_FILENAME} !-d\n" .
              "    RewriteRule . /index.php [L]\n" .
              "</IfModule>\n\n" .
              "# Security headers\n" .
              "<IfModule mod_headers.c>\n" .
              "    Header set X-Content-Type-Options \"nosniff\"\n" .
              "    Header set X-XSS-Protection \"1; mode=block\"\n" .
              "    Header set Strict-Transport-Security \"max-age=31536000; includeSubDomains\"\n" .
              "</IfModule>\n\n" .
              "# Caching\n" .
              "<IfModule mod_expires.c>\n" .
              "    ExpiresActive On\n" .
              "    ExpiresByType image/jpg \"access plus 1 year\"\n" .
              "    ExpiresByType image/jpeg \"access plus 1 year\"\n" .
              "    ExpiresByType image/gif \"access plus 1 year\"\n" .
              "    ExpiresByType image/png \"access plus 1 year\"\n" .
              "    ExpiresByType image/webp \"access plus 1 year\"\n" .
              "    ExpiresByType image/svg+xml \"access plus 1 year\"\n" .
              "    ExpiresByType text/css \"access plus 1 month\"\n" .
              "    ExpiresByType application/javascript \"access plus 1 month\"\n" .
              "    ExpiresByType text/html \"access plus 1 hour\"\n" .
              "</IfModule>\n\n" .
              "# Prevent directory listing\n" .
              "Options -Indexes\n";
    
    file_put_contents($htaccessPath, $content);
    echo "  Created: {$htaccessPath}\n";
}

/**
 * Create site template
 */
function createSiteTemplate() {
    global $firstSiteDir;
    
    $templatePath = $firstSiteDir . '/bitrix/templates/dianomi';
    
    if (is_dir($templatePath)) {
        echo "  Already exists: {$templatePath}/\n";
        return;
    }
    
    // Create template directory
    if (!mkdir($templatePath, 0755, true)) {
        exit("Error: Failed to create template directory\n");
    }
    
    // Create .description.php
    $descriptionPath = $templatePath . '/.description.php';
    $descriptionContent = "<?php\n" .
                         "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                         "return [\n" .
                         "    'ID' => 'dianomi',\n" .
                         "    'NAME' => 'Dianomi Template',\n" .
                         "    'DESCRIPTION' => 'Template for dianomi.ru site',\n" .
                         "    'VERSION' => [\n" .
                         "        'NAME' => '1.0.0',\n" .
                         "    ],\n" .
                         "    'SORT' => 100,\n" .
                         "    'TYPES' => ['index', 'about', 'contacts', 'catalog'],\n" .
                         "    'COMPONENT' => [\n" .
                         "        'NAME' => '',\n" .
                         "        'ID' => '',\n" .
                         "    ],\n" .
                         "];\n";
    
    file_put_contents($descriptionPath, $descriptionContent);
    
    // Create header.php
    $headerPath = $templatePath . '/header.php';
    $headerContent = "<?php\n" .
                    "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                    "?>\n" .
                    "<header class=\"header\">\n" .
                    "    <div class=\"container\">\n" .
                    "        <a href=\"/\" class=\"logo\">\n" .
                    "            <img src=\"/bitrix/templates/dianomi/img/logo.png\" alt=\"Dianomi\">\n" .
                    "        </a>\n" .
                    "        <nav class=\"navigation\">\n" .
                    "            <?php \$APPLICATION->IncludeComponent(\"bitrix:menu\", \"top\", array(\n" .
                    "                \"ALLOW_MULTI_SELECT\" => \"N\",\n" .
                    "                \"CHECK_CLOSE\" => \"N\",\n" .
                    "                \"USE_EXT\" => \"Y\",\n" .
                    "                \"MENU_CACHE_TYPE\" => \"Y\",\n" .
                    "                \"MENU_CACHE_TIME\" => \"600\",\n" .
                    "            ), false);\n" .
                    "            ?>\n" .
                    "        </nav>\n" .
                    "    </div>\n" .
                    "</header>\n";
    
    file_put_contents($headerPath, $headerContent);
    
    // Create footer.php
    $footerPath = $templatePath . '/footer.php';
    $footerContent = "<?php\n" .
                    "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                    "?>\n" .
                    "<footer class=\"footer\">\n" .
                    "    <div class=\"container\">\n" .
                    "        <p>&copy; <?php echo date('Y'); ?> Dianomi</p>\n" .
                    "    </div>\n" .
                    "</footer>\n";
    
    file_put_contents($footerPath, $footerContent);
    
    // Create img directory
    $imgPath = $templatePath . '/img';
    if (!is_dir($imgPath)) {
        mkdir($imgPath, 0755, true);
        file_put_contents($imgPath . '/.gitkeep', '');
    }
    
    echo "  Created: {$templatePath}/\n";
    echo "    - .description.php\n";
    echo "    - header.php\n";
    echo "    - footer.php\n";
    echo "    - img/\n";
}

/**
 * Create Apache configuration
 */
function createApacheConfig() {
    $configPath = dirname(__DIR__) . '/docs/examples/apache-vhost.conf';
    $configDir = dirname($configPath);
    
    if (!is_dir($configDir)) {
        mkdir($configDir, 0755, true);
    }
    
    $content = "#\n" .
              "# Apache VirtualHost configuration for Multi-Site\n" .
              "# Location: docs/examples/apache-vhost.conf\n" .
              "#\n" .
              "# Install:\n" .
              "#   sudo cp apache-vhost.conf /etc/apache2/sites-available/bx-pool.conf\n" .
              "#   sudo a2ensite bx-pool.conf\n" .
              "#   sudo systemctl restart apache2\n" .
              "#\n\n" .
              "# Site 1: dianomi.ru\n" .
              "<VirtualHost *:80>\n" .
              "    DocumentRoot \"/var/www/site-dianomi\"\n" .
              "    ServerName dianomi.ru\n" .
              "    ServerAlias www.dianomi.ru\n" .
              "\n" .
              "    <Directory \"/var/www/site-dianomi\">\n" .
              "        AllowOverride All\n" .
              "        Require all granted\n" .
              "    </Directory>\n" .
              "\n" .
              "    # Redirect to HTTPS (optional)\n" .
              "    # RewriteEngine On\n" .
              "    # RewriteCond %{HTTPS} off\n" .
              "    # RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]\n" .
              "\n" .
              "    ErrorLog \${APACHE_LOG_DIR}/dianomi_error.log\n" .
              "    CustomLog \${APACHE_LOG_DIR}/dianomi_access.log combined\n" .
              "</VirtualHost>\n\n" .
              "# Site 2: shop.ru\n" .
              "<VirtualHost *:80>\n" .
              "    DocumentRoot \"/var/www/site-shop\"\n" .
              "    ServerName shop.ru\n" .
              "    ServerAlias www.shop.ru\n" .
              "\n" .
              "    <Directory \"/var/www/site-shop\">\n" .
              "        AllowOverride All\n" .
              "        Require all granted\n" .
              "    </Directory>\n" .
              "\n" .
              "    ErrorLog \${APACHE_LOG_DIR}/shop_error.log\n" .
              "    CustomLog \${APACHE_LOG_DIR}/shop_access.log combined\n" .
              "</VirtualHost>\n\n" .
              "# Site 3: blog.ru\n" .
              "<VirtualHost *:80>\n" .
              "    DocumentRoot \"/var/www/site-blog\"\n" .
              "    ServerName blog.ru\n" .
              "    ServerAlias www.blog.ru\n" .
              "\n" .
              "    <Directory \"/var/www/site-blog\">\n" .
              "        AllowOverride All\n" .
              "        Require all granted\n" .
              "    </Directory>\n" .
              "\n" .
              "    ErrorLog \${APACHE_LOG_DIR}/blog_error.log\n" .
              "    CustomLog \${APACHE_LOG_DIR}/blog_access.log combined\n" .
              "</VirtualHost>\n\n" .
              "# HTTPS configuration (optional)\n" .
              "# Uncomment and configure SSL certificates\n" .
              "#\n" .
              "# <VirtualHost *:443>\n" .
              "#     DocumentRoot \"/var/www/site-dianomi\"\n" .
              "#     ServerName dianomi.ru\n" .
              "#\n" .
              "#     SSLEngine On\n" .
              "#     SSLCertificateFile /etc/ssl/certs/dianomi.crt\n" .
              "#     SSLCertificateKeyFile /etc/ssl/private/dianomi.key\n" .
              "#     SSLCertificateChainFile /etc/ssl/certs/chain.crt\n" .
              "#\n" .
              "#     <Directory \"/var/www/site-dianomi\">\n" .
              "#         AllowOverride All\n" .
              "#         Require all granted\n" .
              "#     </Directory>\n" .
              "# </VirtualHost>\n";
    
    file_put_contents($configPath, $content);
    echo "  Created: {$configPath}\n";
}
