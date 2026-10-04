<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
/** @var array $arParams */
/** @var CBitrixComponentTemplate $this */
/** @var CMain $APPLICATION */
?>

<main id="main-content">

<?php
if (isset($arResult['ERROR']) && is_array($arResult['ERROR'])):
    ShowError(implode('<br>', $arResult['ERROR']));
else:
    // Если контент страницы пустой — используем стандартный вывод
    if (empty($arResult)):
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "FILE_MANUAL" => $_SERVER["DOCUMENT_ROOT"]."/include/".$APPLICATION->GetPageProp("include_file"),
                "AREA_FILE_SHOW" => "sections",
                "PATH" => SITE_DIR."include/",
            ),
            $componentParent
        );
    endif;
endif;
?>

</main>
