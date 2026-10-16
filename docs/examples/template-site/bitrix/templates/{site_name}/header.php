<?php
/**
 * Template Header for New Bitrix Site
 * 
 * Location: template-site/bitrix/templates/{site_name}/header.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Get current site
$siteCode = getCurrentSiteCode();
?>

<header class="header">
    <div class="header-top">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <a href="/<?php echo $siteCode; ?>/" class="logo__link">
                    <img src="/<?php echo $siteCode; ?>/bitrix/templates/<?php echo $siteCode; ?>/img/logo.png" 
                         alt="<?php echo $currentSiteConfig['name']; ?>" 
                         class="logo__img">
                </a>
            </div>
            
            <!-- Navigation -->
            <nav class="navigation" id="main-nav">
                <?php if (isset($MENU_ARRAY) && is_array($MENU_ARRAY)): ?>
                    <ul class="nav-menu">
                        <?php foreach ($MENU_ARRAY as $item): ?>
                            <li class="nav-item<?php echo isset($item['SELECTED']) && $item['SELECTED'] ? ' active' : ''; ?>">
                                <a href="<?php echo $item['LINK_URL']; ?>" 
                                   class="nav-link"
                                   <?php if (isset($item['PARAMS']['BOOTSTRAP_TOGGLE']) && $item['PARAMS']['BOOTSTRAP_TOGGLE']): ?>
                                   data-toggle="collapse"
                                   data-target="#<?php echo $item['ANOTHER_ID']; ?>"
                                   <?php endif; ?>>
                                    <?php echo $item['TEXT']; ?>
                                </a>
                                
                                <?php if (isset($item['CHILD_ITEMS']) && is_array($item['CHILD_ITEMS']) && count($item['CHILD_ITEMS']) > 0): ?>
                                    <ul class="submenu" id="<?php echo $item['ANOTHER_ID']; ?>">
                                        <?php foreach ($item['CHILD_ITEMS'] as $subItem): ?>
                                            <li class="submenu-item">
                                                <a href="<?php echo $subItem['LINK_URL']; ?>" class="submenu-link">
                                                    <?php echo $subItem['TEXT']; ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <!-- Contacts -->
            <div class="header-contacts">
                <a href="tel:+70001234567" class="contacts__phone">+7 (000) 123-45-67</a>
                <button class="btn btn--callback" data-bs-toggle="modal" data-bs-target="#callbackModal">
                    Заказать звонок
                </button>
            </div>
        </div>
    </div>
    
    <!-- Slider/Banner Area (if needed) -->
    <?php if (isset($BANNER_DATA)): ?>
        <div class="header-banner">
            <div class="container">
                <?php echo $BANNER_DATA; ?>
            </div>
        </div>
    <?php endif; ?>
    
</header>

<!-- JavaScript for mobile menu -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const navigation = document.getElementById('main-nav');
    
    if (mobileToggle && navigation) {
        mobileToggle.addEventListener('click', function() {
            navigation.classList.toggle('active');
            mobileToggle.classList.toggle('active');
        });
    }
});
</script>
