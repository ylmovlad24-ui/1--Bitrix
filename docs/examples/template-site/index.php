<?php
/**
 * Template Index File for New Bitrix Site
 * 
 * This is the main entry point for a new site in multi-site setup.
 * Copy this file to {site_name}/index.php when creating a new site.
 * 
 * Location: template-site/index.php
 */

define("STOP_STATISTICS", true);
define("NO_AGENT_STATISTICS", true);
define("NO_AGENT_CHECK", true);
define("DisableEventsCheck", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Get current site information
$siteCode = getCurrentSiteCode();
$currentSiteConfig = getSiteConfig($siteCode);

// Site-specific settings can be added here
if ($siteCode === 'dianomi') {
    // Dianomi-specific initialization
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
        echo $APPLICATION->getTitle(); 
        ?>
    </title>
    <meta name="description" content="<?php echo $APPLICATION->getMetaDataTags('description'); ?>">
    
    <!-- Site-specific CSS -->
    <link rel="stylesheet" href="/<?php echo $siteCode; ?>/bitrix/templates/<?php echo $siteCode; ?>/styles.css">
    
    <!-- Common styles -->
    <link rel="stylesheet" href="/bitrix/styles/common.css">
    
    <?php 
    // Output bitrix head scripts
    $APPLICATION->setHeadTitle();
    $APPLICATION->addHeadScript();
    $APPLICATION->addHeadString();
    ?>
</head>
<body>
    <div class="site-wrapper site-<?php echo $siteCode; ?>">
        
        <!-- Header -->
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/{$siteCode}/header.php"); ?>
        
        <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                <?php 
                // Main content is managed by Bitrix
                // Page content will be rendered here by Bitrix template
                ?>
                <div class="content-area">
                    <?php $APPLICATION->showContent(); ?>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/{$siteCode}/footer.php"); ?>
        
    </div>
    
    <!-- Site-specific JS -->
    <script src="/<?php echo $siteCode; ?>/bitrix/templates/<?php echo $siteCode; ?>/js/main.js"></script>
    
    <!-- Common JS -->
    <script src="/bitrix/js/common.js"></script>
    
    <?php 
    // Output bitrix foot scripts
    $APPLICATION->addHeadScript();
    $APPLICATION->addHeadString(false);
    ?>
    
</body>
</html>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog.php"); ?>
