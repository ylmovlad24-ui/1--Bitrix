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
<ul class="header__nav-list">
<?foreach($menulines as $line):?>
    <?
    $class = $line["PERMISSION"] > $arResult["MIN_PERMISSION"] ? "header__nav-link" : "";
    $disabled = $line["PERMISSION"] <= $arResult["MIN_PERMISSION"] ? ' style="pointer-events:none;opacity:0.5;"' : "";
    $target = !empty($line["TARGET"]) ? ' target="'.htmlspecialcharsbx($line["TARGET"]).'"' : '';
    $href = $line["PERMISSION"] > $arResult["MIN_PERMISSION"] ? htmlspecialcharsbx($line["LINK"]) : '#';
    $hasSub = !empty($line["SUB_LIST"]);
    $liClass = $hasSub ? ' class="nav-dropdown"' : '';
    ?>
    <li<?=$liClass?>>
        <a href="<?=$href?>" class="<?=$class?>"<?=$disabled?>><?=htmlspecialcharsbx($line["TEXT"])?></a>
        <?if($hasSub):?>
        <div class="mega-menu">
            <div class="mega-menu__col">
                <h4 class="mega-menu__heading"><?=htmlspecialcharsbx($line["TEXT"])?></h4>
                <ul class="mega-menu__list">
                <?foreach($line["SUB_LIST"] as $subitem):?>
                    <?if($subitem["PERMISSION"] > $arResult["MIN_PERMISSION"]):?>
                    <li>
                        <a href="<?=htmlspecialcharsbx($subitem["LINK"])?>"
                           <?=!empty($subitem["TARGET"]) ? 'target="'.htmlspecialcharsbx($subitem["TARGET"]).'"' : ''?>>
                            <?=htmlspecialcharsbx($subitem["TEXT"])?>
                        </a>
                    </li>
                    <?endif;?>
                <?endforeach;?>
                </ul>
            </div>
        </div>
        <?endif;?>
    </li>
<?endforeach;?>
</ul>