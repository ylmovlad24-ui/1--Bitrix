#!/usr/bin/env php
<?php
/**
 * Script to create a new site in Multi-Site Bitrix setup
 * 
 * CORRECT structure according to OFFICIAL Bitrix documentation:
 * - NO separate bitrix/ folder in each site
 * - All sites share ONE bitrix/ installation
 * - Each site has ONLY page files (index.php, about.php, etc.)
 * 
 * Usage:
 *   php scripts/create-new-site-correct.php --name=shop --domain=site.ru
 * 
 * Location: scripts/create-new-site-correct.php
 */

// Configuration
$projectRoot = dirname(__DIR__);
$siteRoot = $projectRoot; // Same root for all sites (one domain mode)

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
$siteTitle = isset($args['title']) ? $args['title'] : ucfirst($siteName);

echo "========================================\n";
echo "Creating new site (OFFICIAL Bitrix)\n";
echo "========================================\n\n";

echo "Site Name: {$siteName}\n";
echo "Domain: {$domain}\n";
echo "Title: {$siteTitle}\n";
echo "Folder: /{$siteName}/\n\n";

echo "✅ CORRECT structure (per Bitrix docs):\n";
echo "   - ONE shared bitrix/ in root\n";
echo "   - Site folder contains ONLY page files\n";
echo "   - NO bitrix/ folder inside site\n\n";

// Step 1: Create site directory structure (ONLY page files)
echo "[1/5] Creating site directory...\n";
createSiteDirectory($siteRoot, $siteName);

// Step 2: Create index.php for the site
echo "[2/5] Creating index.php...\n";
createSiteIndex($siteRoot, $siteName, $siteTitle);

// Step 3: Create .htaccess
echo "[3/5] Creating .htaccess...\n";
createHtaccess($siteRoot, $siteName);

// Step 4: Create site-specific template
echo "[4/5] Creating site template...\n";
createSiteTemplate($siteRoot, $siteName, $siteTitle);

// Step 5: Create documentation
echo "[5/5] Creating documentation...\n";
createSiteDocumentation($siteRoot, $siteName, $domain, $siteTitle);

echo "\n========================================\n";
echo "Site created successfully!\n";
echo "========================================\n\n";

echo "✅ Structure is CORRECT per Bitrix documentation:\n";
echo "/var/www/site.ru/\n";
echo "├── bitrix/              ← SHARED (one installation)\n";
echo "├── upload/              ← SHARED\n";
echo "├── local/               ← SHARED\n";
echo "├── index.php            ← Site 1 (root)\n";
echo "├── dianomi/             ← Site 2 (page files only)\n";
echo "│   ├── index.php\n";
echo "│   └── prices.php\n";
echo "└── shop/                ← Site 3 (page files only)\n";
echo "    ├── index.php\n";
echo "    └── catalog.php\n\n";

echo "Next steps:\n";
echo "1. Add site in Bitrix Admin: Settings → Site Management\n";
echo "2. Set domain: {$domain}\n";
echo "3. Set folder: /{$siteName}/\n";
echo "4. Clear cache: Settings → System Settings → Cache\n\n";

exit(0);

/**
 * Parse command line arguments
 */
function parseArguments($argv) {
    $args = [];
    array_shift($argv);
    
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
 * Create site directory (ONLY for page files)
 */
function createSiteDirectory($siteRoot, $siteName) {
    $directory = "/{$siteName}";
    $fullPath = $siteRoot . $directory;
    
    if (!is_dir($fullPath)) {
        if (!mkdir($fullPath, 0755, true)) {
            exit("Error: Failed to create directory: {$fullPath}\n");
        }
    }
    
    echo "  Created: {$directory}/\n";
}

/**
 * Create index.php for the site
 */
function createSiteIndex($siteRoot, $siteName, $siteTitle) {
    $indexPath = "/{$siteName}/index.php";
    $indexContent = "<?php\n" .
                   "/**\n" .
                   " * Index page for site: {$siteName}\n" .
                   " * \n" .
                   " * Location: /{$siteName}/index.php\n" .
                   " * \n" .
                   " * NOTE: This site shares bitrix/ with all other sites.\n" .
                   " * DO NOT create bitrix/ folder inside this site!\n" .
                   " */\n\n" .
                   "define(\"STOP_STATISTICS\", true);\n" .
                   "define(\"NO_AGENT_STATISTICS\", true);\n" .
                   "define(\"NO_AGENT_CHECK\", true);\n\n" .
                   "require($_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_before.php\");\n\n" .
                   "// Site-specific initialization (optional)\n" .
                   "// define('{$siteName}_SITE', true);\n\n" .
                   "require($_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_after.php\");\n\n" .
                   "?>\n" .
                   "<!DOCTYPE html>\n" .
                   "<html>\n" .
                   "<head>\n" .
                   "    <meta charset=\"UTF-8\">\n" .
                   "    <title>{$siteTitle}</title>\n" .
                   "</head>\n" .
                   "<body>\n" .
                   "    <h1>{$siteTitle}</h1>\n" .
                   "    <?php \$APPLICATION->showContent(); ?>\n" .
                   "</body>\n" .
                   "</html>\n\n" .
                   "<?php require($_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/epilog.php\"); ?>\n";
    
    file_put_contents($siteRoot . $indexPath, $indexContent);
    echo "  Created: {$indexPath}\n";
}

/**
 * Create .htaccess for the site
 */
function createHtaccess($siteRoot, $siteName) {
    $htaccessPath = "/{$siteName}/.htaccess";
    $htaccessContent = "#\n" .
                      "# HTAccess for {$siteName}\n" .
                      "# Part of multi-site setup on ONE domain\n" .
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
                      "# Caching static files\n" .
                      "<IfModule mod_expires.c>\n" .
                      "    ExpiresActive On\n" .
                      "    ExpiresByType image/jpg \"access plus 1 year\"\n" .
                      "    ExpiresByType image/jpeg \"access plus 1 year\"\n" .
                      "    ExpiresByType image/gif \"access plus 1 year\"\n" .
                      "    ExpiresByType image/png \"access plus 1 year\"\n" .
                      "    ExpiresByType text/css \"access plus 1 month\"\n" .
                      "    ExpiresByType application/javascript \"access plus 1 month\"\n" .
                      "</IfModule>\n";
    
    file_put_contents($siteRoot . $htaccessPath, $htaccessContent);
    echo "  Created: {$htaccessPath}\n";
}

/**
 * Create site-specific template in SHARED bitrix/templates/
 */
function createSiteTemplate($siteRoot, $siteName, $siteTitle) {
    $templatePath = "/bitrix/templates/{$siteName}";
    $fullPath = $siteRoot . $templatePath;
    
    if (!is_dir($fullPath)) {
        mkdir($fullPath, 0755, true);
    }
    
    // Create .description.php
    $descriptionPath = $fullPath . '/.description.php';
    $descriptionContent = "<?php\n" .
                         "/**\n" .
                         " * Template description for {$siteName}\n" .
                         " * \n" .
                         " * Location: /bitrix/templates/{$siteName}/.description.php\n" .
                         " */\n\n" .
                         "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                         "return [\n" .
                         "    'ID' => '{$siteName}',\n" .
                         "    'NAME' => 'Template for {$siteTitle}',\n" .
                         "    'DESCRIPTION' => 'Custom template for {$siteName} site',\n" .
                         "    'VERSION' => [\n" .
                         "        'NAME' => '1.0.0',\n" .
                         "    ],\n" .
                         "    'SORT' => 100,\n" .
                         "    'TYPES' => ['index', 'about', 'contacts'],\n" .
                         "];\n";
    
    file_put_contents($descriptionPath, $descriptionContent);
    
    // Create header.php
    $headerPath = $fullPath . '/header.php';
    $headerContent = "<?php\n" .
                    "/**\n" .
                    " * Header template for {$siteName}\n" .
                    " * \n" .
                    " * Location: /bitrix/templates/{$siteName}/header.php\n" .
                    " */\n\n" .
                    "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                    "?>\n" .
                    "<header class=\"header header--{$siteName}\">\n" .
                    "    <div class=\"container\">\n" .
                    "        <a href=\"/{$siteName}/\" class=\"logo\">\n" .
                    "            <img src=\"/bitrix/templates/{$siteName}/img/logo.png\" alt=\"{$siteTitle}\">\n" .
                    "        </a>\n" .
                    "        <nav class=\"navigation\">\n" .
                    "            <?php \$APPLICATION->IncludeComponent(\"bitrix:menu\", \"top\", array(\n" .
                    "                \"ALLOW_MULTI_SELECT\" => \"N\",\n" .
                    "                \"CHECK_CLOSE\" => \"N\",\n" .
                    "                \"USE_EXT\" => \"Y\",\n" .
                    "                \"MENU_CACHE_TYPE\" => \"Y\",\n" .
                    "                \"MENU_CACHE_TIME\" => \"600\",\n" .
                    "                \"MENU_CACHE_USE_GROUPS\" => \"Y\",\n" .
                    "                \"MENU_CACHE_USE_USERS\" => \"Y\",\n" .
                    "            ),\n" .
                    "            false,\n" .
                    "            array(\"EMPTY_TEMPLATE\" => \"\", \"DISABLE\" => \"N\")\n" .
                    "        ); ?>\n" .
                    "        </nav>\n" .
                    "    </div>\n" .
                    "</header>\n";
    
    file_put_contents($headerPath, $headerContent);
    
    // Create footer.php
    $footerPath = $fullPath . '/footer.php';
    $footerContent = "<?php\n" .
                    "/**\n" .
                    " * Footer template for {$siteName}\n" .
                    " * \n" .
                    " * Location: /bitrix/templates/{$siteName}/footer.php\n" .
                    " */\n\n" .
                    "if (!defined(\"B_PROLOG_INCLUDED\") || B_PROLOG_INCLUDED !== true) die();\n\n" .
                    "?>\n" .
                    "<footer class=\"footer footer--{$siteName}\">\n" .
                    "    <div class=\"container\">\n" .
                    "        <p>&copy; <?php echo date('Y'); ?> {$siteTitle}</p>\n" .
                    "    </div>\n" .
                    "</footer>\n";
    
    file_put_contents($footerPath, $footerContent);
    
    // Create img directory
    $imgPath = $fullPath . '/img';
    if (!is_dir($imgPath)) {
        mkdir($imgPath, 0755, true);
        // Create placeholder .gitkeep
        file_put_contents($imgPath . '/.gitkeep', '');
    }
    
    echo "  Created: {$templatePath}/\n";
    echo "    - .description.php\n";
    echo "    - header.php\n";
    echo "    - footer.php\n";
    echo "    - img/\n";
}

/**
 * Create site documentation
 */
function createSiteDocumentation($siteRoot, $siteName, $domain, $siteTitle) {
    $docPath = $siteRoot . "/docs/sites/{$siteName}.md";
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
                  "## Structure\n\n" .
                  "This site is part of a multi-site setup on ONE domain.\n\n" .
                  "### What's in this folder:\n" .
                  "- ✅ Page files (index.php, about.php, etc.)\n" .
                  "- ✅ Static assets (css/, js/, img/)\n" .
                  "- ✅ .htaccess\n\n" .
                  "### What's NOT in this folder:\n" .
                  "- ❌ bitrix/ (shared in root)\n" .
                  "- ❌ upload/ (shared in root)\n" .
                  "- ❌ local/ (shared in root)\n\n" .
                  "### Template location:\n" .
                  "- `/bitrix/templates/{$siteName}/`\n\n" .
                  "## Configuration\n\n" .
                  "1. Add site in Bitrix Admin\n" .
                  "2. Set domain: {$domain}\n" .
                  "3. Set folder: /{$siteName}/\n" .
                  "4. Clear cache\n\n";
    
    file_put_contents($docPath, $docContent);
    echo "  Created: docs/sites/{$siteName}.md\n";
}
