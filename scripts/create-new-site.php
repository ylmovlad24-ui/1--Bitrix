#!/usr/bin/env php
<?php
/**
 * Script to create a new site in Multi-Site Bitrix setup
 * 
 * Usage:
 *   php scripts/create-new-site.php --name=newsite --domain=site.ru --db-prefix=newsite
 * 
 * Location: scripts/create-new-site.php
 */

// Configuration
$projectRoot = dirname(__DIR__);
$bitrixCore = $projectRoot . '/bitrix';
$templateSite = $projectRoot . '/docs/examples/template-site';

// Parse command line arguments
$args = parseArguments($argv);

// Validate required parameters
if (empty($args['name'])) {
    exit("Error: --name parameter is required\n");
}

if (empty($args['domain'])) {
    exit("Error: --domain parameter is required\n");
}

$siteName = sanitizeSiteName($args['name']);
$domain = sanitizeDomain($args['domain']);
$dbPrefix = isset($args['db-prefix']) ? sanitizeSiteName($args['db-prefix']) : $siteName;
$templateName = isset($args['template']) ? $args['template'] : $siteName;
$siteTitle = isset($args['title']) ? $args['title'] : ucfirst($siteName);

echo "========================================\n";
echo "Creating new site in Multi-Site setup\n";
echo "========================================\n\n";

echo "Site Name: {$siteName}\n";
echo "Domain: {$domain}\n";
echo "Database Prefix: {$dbPrefix}\n";
echo "Template: {$templateName}\n";
echo "Title: {$siteTitle}\n\n";

// Step 1: Create site directory structure
echo "[1/7] Creating directory structure...\n";
createSiteDirectories($projectRoot, $siteName);

// Step 2: Copy template files
echo "[2/7] Copying template files...\n";
copyTemplateFiles($templateSite, $projectRoot, $siteName);

// Step 3: Create database configuration
echo "[3/7] Creating database configuration...\n";
createDatabaseConfig($projectRoot, $siteName, $dbPrefix);

// Step 4: Create site-specific initialization
echo "[4/7] Creating site initialization...\n";
createSiteInit($projectRoot, $siteName, $siteTitle);

// Step 5: Update global initialization
echo "[5/7] Updating global initialization...\n";
updateGlobalInit($projectRoot, $siteName, $siteTitle);

// Step 6: Create .htaccess
echo "[6/7] Creating .htaccess...\n";
createHtaccess($projectRoot, $siteName);

// Step 7: Create documentation
echo "[7/7] Creating site documentation...\n";
createSiteDocumentation($projectRoot, $siteName, $domain, $siteTitle);

echo "\n========================================\n";
echo "Site created successfully!\n";
echo "========================================\n\n";

echo "Next steps:\n";
echo "1. Update database credentials in: /{$siteName}/bitrix/php_interface/dbconn.{$siteName}.php\n";
echo "2. Copy template files to: /bitrix/templates/{$siteName}/\n";
echo "3. Add site in Bitrix Admin: Settings → Site Management → Add Site\n";
echo "4. Configure site with folder: /{$siteName}/\n";
echo "5. Clear cache: Settings → System Settings → Cache\n\n";

echo "Site structure:\n";
echo "/{$siteName}/\n";
echo "├── index.php\n";
echo "├── bitrix/\n";
echo "│   ├── templates/\n";
echo "│   │   └── {$siteName}/\n";
echo "│   └── php_interface/\n";
echo "│       ├── init.{$siteName}.php\n";
echo "│       └── dbconn.{$siteName}.php\n";
echo "├── components/\n";
echo "├── uploads/\n";
echo "└── logs/\n\n";

exit(0);

/**
 * Parse command line arguments
 */
function parseArguments($argv) {
    $args = [];
    array_shift($argv); // Remove script name
    
    foreach ($argv as $arg) {
        if (strpos($arg, '--') === 0) {
            $parts = explode('=', $arg, 2);
            $key = substr($parts[0], 2);
            $value = isset($parts[1]) ? $parts[1] : true;
            $args[$key] = $value;
        }
    }
    
    return $args;
}

/**
 * Sanitize site name
 */
function sanitizeSiteName($name) {
    $name = strtolower($name);
    $name = preg_replace('/[^a-z0-9_\-]/', '', $name);
    $name = preg_replace('/_+/', '-', $name);
    $name = trim($name, '-_');
    return $name;
}

/**
 * Sanitize domain
 */
function sanitizeDomain($domain) {
    $domain = strtolower($domain);
    if (!preg_match('/^[a-z0-9\.\-]+$/i', $domain)) {
        exit("Error: Invalid domain format\n");
    }
    return $domain;
}

/**
 * Create site directory structure
 */
function createSiteDirectories($projectRoot, $siteName) {
    $directories = [
        "/{$siteName}/bitrix/templates/{$siteName}",
        "/{$siteName}/bitrix/components/{$siteName}",
        "/{$siteName}/bitrix/php_interface",
        "/{$siteName}/components",
        "/{$siteName}/uploads",
        "/{$siteName}/logs",
        "/{$siteName}/css",
        "/{$siteName}/js",
        "/{$siteName}/img",
    ];
    
    foreach ($directories as $dir) {
        $fullPath = $projectRoot . $dir;
        if (!is_dir($fullPath)) {
            if (!mkdir($fullPath, 0755, true)) {
                exit("Error: Failed to create directory: {$fullPath}\n");
            }
        }
    }
    
    // Create empty .gitkeep files in empty directories
    $emptyDirs = [
        "/{$siteName}/bitrix/components/{$siteName}",
        "/{$siteName}/uploads",
        "/{$siteName}/logs",
    ];
    
    foreach ($emptyDirs as $dir) {
        $gitkeep = $projectRoot . $dir . '/.gitkeep';
        if (!file_exists($gitkeep)) {
            file_put_contents($gitkeep, '');
        }
    }
    
    echo "  Created directories for site: {$siteName}\n";
}

/**
 * Copy template files
 */
function copyTemplateFiles($templateSite, $projectRoot, $siteName) {
    $templateIndex = $templateSite . '/index.php';
    
    if (!file_exists($templateIndex)) {
        // Create basic index.php if template doesn't exist
        $indexContent = createBasicIndex($siteName);
        file_put_contents($projectRoot . "/{$siteName}/index.php", $indexContent);
    } else {
        // Copy from template
        $destIndex = $projectRoot . "/{$siteName}/index.php";
        if (!copy($templateIndex, $destIndex)) {
            exit("Error: Failed to copy template index.php\n");
        }
    }
    
    echo "  Copied template files\n";
}

/**
 * Create basic index.php
 */
function createBasicIndex($siteName) {
    return "<?php\n" .
           "/**\n" .
           " * Index page for {$siteName}\n" .
           " */\n\n" .
           "define(\"STOP_STATISTICS\", true);\n" .
           "define(\"NO_AGENT_STATISTICS\", true);\n" .
           "define(\"NO_AGENT_CHECK\", true);\n\n" .
           "require($_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_before.php\");\n\n" .
           "// Site-specific initialization\n" .
           "// define('{$siteName}_SITE', true);\n\n" .
           "require($_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_after.php\");\n\n" .
           "?>\n" .
           "<!DOCTYPE html>\n" .
           "<html>\n" .
           "<head>\n" .
           "    <meta charset=\"UTF-8\">\n" .
           "    <title>{$siteName}</title>\n" .
           "</head>\n" .
           "<body>\n" .
           "    <h1>{$siteName}</h1>\n" .
           "    <?php \$APPLICATION->showContent(); ?>\n" .
           "</body>\n" .
           "</html>\n\n" .
           "<?php require($_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/epilog.php\"); ?>\n";
}

/**
 * Create database configuration
 */
function createDatabaseConfig($projectRoot, $siteName, $dbPrefix) {
    $dbConnPath = "/{$siteName}/bitrix/php_interface/dbconn.{$siteName}.php";
    $dbContent = "<?php\n" .
                "/**\n" .
                " * Database configuration for {$siteName}\n" .
                " * \n" .
                " * Location: /{$siteName}/bitrix/php_interface/dbconn.{$siteName}.php\n" .
                " */\n\n" .
                "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                "// Database settings for {$siteName}\n" .
                "define(\"DB_HOST\", \"localhost\");\n" .
                "define(\"DB_USER\", \"{$dbPrefix}_user\");\n" .
                "define(\"DB_PASSWORD\", \"CHANGE_ME_PASSWORD\");\n" .
                "define(\"DB_NAME\", \"{$dbPrefix}_database\");\n" .
                "define(\"DB_TABLE_PREFIX\", \"b_\");\n\n" .
                "// Connect to database\nglobal \$DB;\n\n" .
                "\$DB->Connect(\n" .
                "    DB_HOST,\n" .
                "    DB_USER,\n" .
                "    DB_PASSWORD,\n" .
                "    DB_NAME\n" .
                ");\n";
    
    file_put_contents($projectRoot . $dbConnPath, $dbContent);
    echo "  Created database configuration\n";
}

/**
 * Create site-specific initialization
 */
function createSiteInit($projectRoot, $siteName, $siteTitle) {
    $initPath = "/{$siteName}/bitrix/php_interface/init.{$siteName}.php";
    $initContent = "<?php\n" .
                   "/**\n" .
                   " * Site-specific initialization for {$siteName}\n" .
                   " * \n" .
                   " * This file is loaded AFTER the global init.php\n" .
                   " * Use this for site-specific event handlers and settings\n" .
                   " * \n" .
                   " * Location: /{$siteName}/bitrix/php_interface/init.{$siteName}.php\n" .
                   " */\n\n" .
                   "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                   "// Define site constant\ndefine('{$siteName}_SITE', true);\ndefine('CURRENT_SITE_TITLE', '{$siteTitle}');\n\n" .
                   "// Site-specific event handlers\n" .
                   "// AddEventHandler(\"main\", \"OnEpilog\", function() {\n" .
                   "//     // Your code here\n" .
                   "// });\n\n" .
                   "// Site-specific settings\n" .
                   "// define('SITE_SETTING_KEY', 'value');\n\n";
    
    file_put_contents($projectRoot . $initPath, $initContent);
    echo "  Created site initialization\n";
}

/**
 * Update global initialization
 */
function updateGlobalInit($projectRoot, $siteName, $siteTitle) {
    $globalInitPath = $projectRoot . '/docs/examples/bitrix/php_interface/init.php';
    
    if (file_exists($globalInitPath)) {
        $content = file_get_contents($globalInitPath);
        
        // Check if site case already exists
        if (strpos($content, "case '{$siteName}':") === false) {
            // Add new case before the default case
            $newCase = "\n    case '{$siteName}':\n" .
                      "        // {$siteName} site specific settings\n" .
                      "        define('{$siteName}_SITE', true);\n" .
                      "        define('CURRENT_SITE_CODE', '{$siteName}');\n" .
                      "        break;\n";
            
            $content = str_replace(
                "    default:\n",
                $newCase . "\n    default:\n",
                $content
            );
            
            file_put_contents($globalInitPath, $content);
            echo "  Updated global initialization with new site case\n";
        } else {
            echo "  Site case already exists in global initialization\n";
        }
    } else {
        echo "  Warning: Global init file not found, create manually\n";
    }
}

/**
 * Create .htaccess
 */
function createHtaccess($projectRoot, $siteName) {
    $htaccessPath = "/{$siteName}/.htaccess";
    $htaccessContent = "#\n" .
                      "# HTAccess for {$siteName}\n" .
                      "# Copy to: /{$siteName}/.htaccess\n" .
                      "#\n\n" .
                      "<IfModule mod_rewrite.c>\n" .
                      "    RewriteEngine On\n" .
                      "    RewriteBase /\n" .
                      "\n" .
                      "    # Redirect to Bitrix\n" .
                      "    RewriteCond %{REQUEST_FILENAME} !-f\n" .
                      "    RewriteCond %{REQUEST_FILENAME} !-d\n" .
                      "    RewriteRule . /{$siteName}/index.php [L]\n" .
                      "</IfModule>\n\n" .
                      "# Security headers\n" .
                      "<IfModule mod_headers.c>\n" .
                      "    Header set X-Content-Type-Options \"nosniff\"\n" .
                      "    Header set X-XSS-Protection \"1; mode=block\"\n" .
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
                      "</IfModule>\n";
    
    file_put_contents($projectRoot . $htaccessPath, $htaccessContent);
    echo "  Created .htaccess\n";
}

/**
 * Create site documentation
 */
function createSiteDocumentation($projectRoot, $siteName, $domain, $siteTitle) {
    $docPath = $projectRoot . "/docs/sites/{$siteName}.md";
    $docDir = dirname($docPath);
    
    if (!is_dir($docDir)) {
        mkdir($docDir, 0755, true);
    }
    
    $docContent = "# {$siteTitle}\n\n" .
                  "Site information for {$siteName}.\n\n" .
                  "## Basic Info\n\n" .
                  "| Property | Value |\n" .
                  "|----------|-------|\n" .
                  "| Site Code | {$siteName} |\n" .
                  "| Domain | {$domain} |\n" .
                  "| Title | {$siteTitle} |\n" .
                  "| Folder | /{$siteName}/ |\n" .
                  "| Created | " . date('Y-m-d H:i:s') . " |\n\n" .
                  "## Database\n\n" .
                  "- **Host:** localhost\n" .
                  "- **User:** {$siteName}_user\n" .
                  "- **Database:** {$siteName}_database\n" .
                  "- **Prefix:** b_\n\n" .
                  "## Configuration\n\n" .
                  "1. Update database credentials in: `/{$siteName}/bitrix/php_interface/dbconn.{$siteName}.php`\n" .
                  "2. Configure site in Bitrix Admin\n" .
                  "3. Set up template in `/bitrix/templates/{$siteName}/`\n\n" .
                  "## Files\n\n" .
                  "- Main index: `/{$siteName}/index.php`\n" .
                  "- Database config: `/{$siteName}/bitrix/php_interface/dbconn.{$siteName}.php`\n" .
                  "- Site init: `/{$siteName}/bitrix/php_interface/init.{$siteName}.php`\n\n";
    
    file_put_contents($docPath, $docContent);
    echo "  Created site documentation\n";
}
