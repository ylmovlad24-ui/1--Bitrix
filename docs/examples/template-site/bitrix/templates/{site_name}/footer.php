<?php
/**
 * Template Footer for New Bitrix Site
 * 
 * Location: template-site/bitrix/templates/{site_name}/footer.php
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$siteCode = getCurrentSiteCode();
?>

<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                
                <!-- Company Info -->
                <div class="footer-col footer-col--company">
                    <div class="footer-logo">
                        <a href="/<?php echo $siteCode; ?>/" class="footer-logo__link">
                            <img src="/<?php echo $siteCode; ?>/bitrix/templates/<?php echo $siteCode; ?>/img/logo-white.png" 
                                 alt="<?php echo $currentSiteConfig['name']; ?>" 
                                 class="footer-logo__img">
                        </a>
                    </div>
                    <p class="footer-description">
                        <?php echo $currentSiteConfig['name']; ?> - профессиональные решения для вашего бизнеса
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link social-link--telegram" target="_blank">
                            <svg class="social-icon"><use href="#icon-telegram"></use></svg>
                        </a>
                        <a href="#" class="social-link social-link--whatsapp" target="_blank">
                            <svg class="social-icon"><use href="#icon-whatsapp"></use></svg>
                        </a>
                        <a href="#" class="social-link social-link--vk" target="_blank">
                            <svg class="social-icon"><use href="#icon-vk"></use></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="footer-col footer-col--nav">
                    <h3 class="footer-col__title">Навигация</h3>
                    <ul class="footer-nav">
                        <li><a href="/<?php echo $siteCode; ?>/" class="footer-nav__link">Главная</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/about.php" class="footer-nav__link">О компании</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/services.php" class="footer-nav__link">Услуги</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/cases.php" class="footer-nav__link">Кейсы</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/contacts.php" class="footer-nav__link">Контакты</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div class="footer-col footer-col--services">
                    <h3 class="footer-col__title">Услуги</h3>
                    <ul class="footer-services">
                        <li><a href="/<?php echo $siteCode; ?>/bitrix24.php" class="footer-services__link">Битрикс24</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/1c-bitrix.php" class="footer-services__link">1C-Битрикс</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/web-systems.php" class="footer-services__link">Веб-системы</a></li>
                        <li><a href="/<?php echo $siteCode; ?>/business-systems.php" class="footer-services__link">Бизнес-системы</a></li>
                    </ul>
                </div>
                
                <!-- Contacts -->
                <div class="footer-col footer-col--contacts">
                    <h3 class="footer-col__title">Контакты</h3>
                    <div class="footer-contacts">
                        <a href="tel:+70001234567" class="footer-contacts__phone">+7 (000) 123-45-67</a>
                        <a href="mailto:info@site.ru" class="footer-contacts__email">info@site.ru</a>
                        <address class="footer-contacts__address">
                            г. Москва, ул. Примерная, д. 1, офис 100
                        </address>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom__inner">
                <p class="footer-bottom__copyright">
                    © <?php echo date('Y'); ?> <?php echo $currentSiteConfig['name']; ?>. Все права защищены.
                </p>
                <div class="footer-bottom__links">
                    <a href="/<?php echo $siteCode; ?>/policy.php" class="footer-bottom__link">
                        Политика конфиденциальности
                    </a>
                    <?php if (class_exists('Bitrix\\Main\\Localization\\Loc')): ?>
                        <?php echo \Bitrix\Main\Localization\Loc::getMessage('FOOTER_DEV_SITE'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
</footer>

<!-- Callback Modal -->
<div class="modal fade" id="callbackModal" tabindex="-1" aria-labelledby="callbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="callbackModalLabel">Заказать звонок</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                // Show form component or include form template
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    [
                        "TEMPLATE_THEME" => "blue",
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => $_SERVER["DOCUMENT_ROOT"] . "/" . $siteCode . "/components/forms/callback.php"
                    ],
                    false
                );
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 5V19M12 5L6 11M12 5L18 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</button>
