<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult):?>
<nav class="header__nav" aria-label="Основная навигация">
  <ul class="header__nav-list">
    <?foreach($arResult as $arItem):?>
      <?if($arItem["PERMISSION"] > $APPLICATION->GetGroupID()):?>
        <li class="<?=($arItem["HAS_CHILD"] ? "nav-dropdown" : "")?>">
          <a href="<?=$arItem["LINK"]?>" class="header__nav-link"><?=$arItem["TEXT"]?></a>
          
          <?if($arItem["HAS_CHILD"] && !empty($arItem["CHILD"])):?>
          <div class="mega-menu">
            <?$colCount = 0;
             $childItems = array_chunk($arItem["CHILD"], ceil(count($arItem["CHILD"]) / 3));
             foreach($childItems as $colItems):?>
            <div class="mega-menu__col">
              <h4 class="mega-menu__heading"><?=$colItems[0]["TEXT"]?></h4>
              <ul class="mega-menu__list">
                <?foreach($colItems as $childItem):?>
                  <?if($childItem["PERMISSION"] > $APPLICATION->GetGroupID()):?>
                  <li><a href="<?=$childItem["LINK"]?>"><?=$childItem["TEXT"]?></a></li>
                  <?endif;?>
                <?endforeach;?>
              </ul>
            </div>
            <?$colCount++;endforeach;?>
          </div>
          <?endif;?>
        </li>
      <?endif;?>
    <?endforeach;?>
  </ul>
</nav>
<?endif;?>
