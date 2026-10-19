<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?$APPLICATION->IncludeRegion("dianomi.footer.region");?>

<footer class="footer">
  <div class="container">
    <div class="footer__inner">
      <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
        "INCLUDE_ID" => "dianomi.footer.brand",
        "INCLUDE_AREA_COMPS" => "Y",
        "TEMPLATE_STYLE" => "default",
      ), false);?>

      <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
        "ALLOW_MULTI_SELECTION" => "N",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "ALLOW_CUSTOMIZE_MENU" => "N",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_USE_USERS" => "Y",
      ), false);?>

      <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
        "INCLUDE_ID" => "dianomi.footer.about",
        "INCLUDE_AREA_COMPS" => "Y",
        "TEMPLATE_STYLE" => "default",
      ), false);?>
    </div>

    <div class="footer__copyright">
      &copy; <span id="currentYear">2026</span> dianomi. Все права защищены.
    </div>
  </div>
</footer>

<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
</body>
</html>
