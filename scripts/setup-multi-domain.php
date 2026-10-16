#!/usr/bin/env php
<?php
/**
 * Script to setup Multi-Site with different domains
 * 
 * This script sets up the shared directory structure and symbolic links
 * for Bitrix multi-site configuration on different domains.
 * 
 * Usage:
 *   php scripts/setup-multi-domain.php
 * 
 * Location: scripts/setup-multi-domain.php
 */

// Configuration
$baseDir = '/var/www';
$sharedDir = $baseDir . '/shared';
$sites = [
    'dianomi' => [
        'dir' => $baseDir . '/site-dianomi',
        'domain' => 'dianomi.ru',
        'www_domain' => 'www.dianomi.ru',
        'title' => 'Dianomi Site',
        'template' => 'dianomi',
    ],
    'shop' => [
        'dir' => $baseDir . '/site-shop',
        'domain' => 'shop.ru',
        'www_domain' => 'www.shop.ru',
        'title' => 'Shop Site',
        'template' => 'shop',
    ],
    'blog' => [
        'dir' => $baseDir . '/site-blog',
        'domain' => 'blog.ru',
        'www_domain' => 'www.blog.ru',
        'title' => 'Blog Site',
        'template' => 'blog',
    ],
];

echo "========================================\n";
echo "Multi-Site Setup - Different Domains\n";
echo "========================================\n\n";

// Step 1: Create shared directory
echo "[1/6] Creating shared directory...\n";
createSharedDirectory();

// Step 2: Create site directories
echo "[2/6] Creating site directories...\n";
createSiteDirectories();

// Step 3: Check if Bitrix is installed
echo "[3/6] Checking Bitrix installation...\n";
$bitrixInstalled = checkBitrixInstallation();

if (!$bitrixInstalled) {
    echo "\n⚠️  Bitrix not installed yet.\n";
    echo "   Please install Bitrix first in: {$sites['dianomi']['dir']}\n";
    echo "   Then run this script again.\n\n";
    exit(0);
}

// Step 4: Move shared folders
echo "[4/6] Moving shared folders...\n";
moveSharedFolders();

// Step 5: Create symbolic links
echo "[5/6] Creating symbolic links...\n";
createSymbolicLinks();

// Step 6: Create configuration files
echo "[6/6] Creating configuration files...\n";
createConfigurationFiles();

echo "\n========================================\n";
echo "Multi-Site setup complete!\n";
echo "========================================\n\n";

echo "✅ Structure created:\n";
echo "/var/www/shared/\n";
echo "├── bitrix/          (shared core)\n";
echo "├── upload/          (shared uploads)\n";
echo "└── local/           (shared files)\n\n";

echo "Site directories:\n";
foreach ($sites as $siteCode => $siteConfig) {
    echo "  - {$siteConfig['dir']}/\n";
    echo "    Domain: {$siteConfig['domain']}\n";
    echo "    Symlinks: bitrix/, upload/, local/\n";
}

echo "\nNext steps:\n";
echo "1. Configure Apache VirtualHost (see docs/MULTISITE-DIFFERENT-DOMAINS.md)\n";
echo "2. Add sites in Bitrix Admin:\n";
foreach ($sites as $siteCode => $siteConfig) {
    echo "   - {$siteConfig['domain']} → {$siteConfig['dir']}/\n";
}
echo "3. Clear cache: Settings → System Settings → Cache\n";
echo "4. Test all sites\n\n";

exit(0);

/**
 * Create shared directory
 */
function createSharedDirectory() {
    global $sharedDir;
    
    if (!is_dir($sharedDir)) {
        if (!mkdir($sharedDir, 0755, true)) {
            exit("Error: Failed to create shared directory: {$sharedDir}\n");
        }
        echo "  Created: {$sharedDir}/\n";
    } else {
        echo "  Already exists: {$sharedDir}/\n";
    }
}

/**
 * Create site directories
 */
function createSiteDirectories() {
    global $sites;
    
    foreach ($sites as $siteCode => $siteConfig) {
        $dir = $siteConfig['dir'];
        
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0755, true)) {
                exit("Error: Failed to create directory: {$dir}\n");
            }
            echo "  Created: {$dir}/\n";
        } else {
            echo "  Already exists: {$dir}/\n";
        }
    }
}

/**
 * Check if Bitrix is installed
 */
function checkBitrixInstallation() {
    global $sites;
    
    $firstSiteDir = $sites['dianomi']['dir'];
    $bitrixPath = $firstSiteDir . '/bitrix';
    
    if (is_dir($bitrixPath)) {
        echo "  Bitrix found in: {$bitrixPath}\n";
        return true;
    }
    
    return false;
}

/**
 * Move shared folders to shared directory
 */
function moveSharedFolders() {
    global $sites, $sharedDir;
    
    $firstSiteDir = $sites['dianomi']['dir'];
    $folders = ['bitrix', 'upload', 'local'];
    
    foreach ($folders as $folder) {
        $source = $firstSiteDir . '/' . $folder;
        $dest = $sharedDir . '/' . $folder;
        
        if (is_dir($source)) {
            if (!is_dir($dest)) {
                if (!rename($source, $dest)) {
                    exit("Error: Failed to move {$folder} to shared directory\n");
                }
                echo "  Moved: {$folder}/ to shared/\n";
            }
        }
    }
}

/**
 * Create symbolic links
 */
function createSymbolicLinks() {
    global $sites, $sharedDir;
    
    $folders = ['bitrix', 'upload', 'local'];
    
    foreach ($sites as $siteCode => $siteConfig) {
        $siteDir = $siteConfig['dir'];
        echo "\n  Site: {$siteCode} ({$siteConfig['domain']})\n";
        
        foreach ($folders as $folder) {
            $target = $sharedDir . '/' . $folder;
            $link = $siteDir . '/' . $folder;
            
            // Remove existing folder if it exists
            if (is_dir($link) || is_file($link)) {
                unlink($link);
            }
            
            // Create symbolic link
            if (!symlink($target, $link)) {
                echo "  Warning: Failed to create symlink: {$link} → {$target}\n";
                echo "  This might be due to permissions. Run as root or with sudo.\n";
            } else {
                echo "    ✓ {$folder}/ → {$target}\n";
            }
        }
    }
}

/**
 * Create configuration files
 */
function createConfigurationFiles() {
    global $sites, $sharedDir;
    
    // Create .htaccess for each site
    foreach ($sites as $siteCode => $siteConfig) {
        $htaccessPath = $siteConfig['dir'] . '/.htaccess';
        
        if (!file_exists($htaccessPath)) {
            $htaccessContent = "#\n" .
                              "# HTAccess for {$siteConfig['domain']}\n" .
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
                              "</IfModule>\n\n" .
                              "# Caching\n" .
                              "<IfModule mod_expires.c>\n" .
                              "    ExpiresActive On\n" .
                              "    ExpiresByType image/jpg \"access plus 1 year\"\n" .
                              "    ExpiresByType image/jpeg \"access plus 1 year\"\n" .
                              "    ExpiresByType image/gif \"access plus 1 year\"\n" .
                              "    ExpiresByType image/png \"access plus 1 year\"\n" .
                              "    ExpiresByType text/css \"access plus 1 month\"\n" .
                              "    ExpiresByType application/javascript \"access plus 1 month\"\n" .
                              "</IfModule>\n";
            
            file_put_contents($htaccessPath, $htaccessContent);
            echo "  Created: {$htaccessPath}\n";
        }
    }
    
    // Create 404.php for each site
    foreach ($sites as $siteCode => $siteConfig) {
        $path404 = $siteConfig['dir'] . '/404.php';
        
        if (!file_exists($path404)) {
            $content404 = "<?php\n" .
                         "/**\n" .
                         " * 404 page for {$siteConfig['domain']}\n" .
                         " */\n\n" .
                         "define(\"STOP_STATISTICS\", true);\n" .
                         "define(\"NO_AGENT_STATISTICS\", true);\n\n" .
                         "require(\$_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_before.php\");\n\n" .
                         "\$APPLICATION->SetTitle(\"Страница не найдена\");\n\n" .
                         "require(\$_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/prolog_after.php\");\n" .
                         "?>\n" .
                         "<!DOCTYPE html>\n" .
                         "<html>\n" .
                         "<head>\n" .
                         "    <meta charset=\"UTF-8\">\n" .
                         "    <title>404 - Страница не найдена</title>\n" .
                         "</head>\n" .
                         "<body>\n" .
                         "    <h1>Страница не найдена</h1>\n" .
                         "    <p>Запрашиваемая страница не существует.</p>\n" .
                         "    <a href=\"/\">Вернуться на главную</a>\n" .
                         "</body>\n" .
                         "</html>\n\n" .
                         "<?php require(\$_SERVER[\"DOCUMENT_ROOT\"] . \"/bitrix/modules/main/include/epilog.php\"); ?>\n";
            
            file_put_contents($path404, $content404);
            echo "  Created: {$path404}\n";
        }
    }
}
