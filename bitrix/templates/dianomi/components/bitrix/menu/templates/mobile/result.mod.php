<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arResult
 */

if(empty($arResult)):
    return;
endif;

$menulines = $arResult["MenuLines"];
if(empty($menulines)):
    return;
endif;
?>
<nav class="mobile-menu" id="mobileMenu" aria-label="Мобильная навигация">
  <ul class="mobile-menu__list">
  <?foreach($menulines as $line):?>
    <?
    $hasSub = !empty($line["SUB_LIST"]);
    $href = $line["PERMISSION"] > $arResult["MIN_PERMISSION"] ? htmlspecialcharsbx($line["LINK"]) : '#';
    $target = !empty($line["TARGET"]) ? ' target="'.htmlspecialcharsbx($line["TARGET"]).'"' : '';
    ?>
    <li class="mobile-menu__item<?if($hasSub):?> mobile-menu__dropdown<?endif;?>">
      <?if($hasSub):?>
        <button class="mobile-menu__dropdown-btn" aria-expanded="false">
          <span><?=htmlspecialcharsbx($line["TEXT"])?></span>
          <span class="mobile-menu__dropdown-icon">&#9670;</span>
        </button>
        <ul class="mobile-menu__dropdown-list" style="display:none;">
        <?foreach($line["SUB_LIST"] as $subitem):?>
          <?if($subitem["PERMISSION"] > $arResult["MIN_PERMISSION"]):?>
          <li>
            <a href="<?=htmlspecialcharsbx($subitem["LINK"])"?><?=!empty($subitem["TARGET"]) ? ' target="'.htmlspecialcharsbx($subitem["TARGET"]).'"' : ''?>">
              <?=htmlspecialcharsbx($subitem["TEXT"])?>
            </a>
          </li>
          <?endif;?>
        <?endforeach;?>
        </ul>
      <?else:?>
        <a href="<?=$href?>" class="mobile-menu__link"<?=$target?>><?=htmlspecialcharsbx($line["TEXT"])?></a>
      <?endif;?>
    </li>
  <?endforeach;?>
  </ul>
  <div class="mobile-menu__cta">
    <a href="/contacts.php" class="btn btn-accent btn-full">Обсудить проект</a>
  </div>
  <div class="mobile-menu__contacts">
    <p style="font-size:0.875rem;color:var(--text-muted);margin:12px 0 4px;">+7 (3852) 000-00-00</p>
    <p style="font-size:0.875rem;color:var(--text-muted);margin:0;">info@dianomi.ru</p>
  </div>
</nav>
