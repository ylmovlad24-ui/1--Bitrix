<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeModuleLangFile(__FILE__);

class dianomiInstall
{
    public $steps = array(
        "check_errors",
        "install_db",
        "install_site",
        "install_files",
        "install_template"
    );

    function CheckErrors()
    {
        global $APPLICATION;
        $errors = array();

        if (!CheckDirPath($_SERVER["DOCUMENT_ROOT"]."/dianomi/")) {
            $errors[] = "Cannot create /dianomi/ directory";
        }

        if (!CheckDirPath($_SERVER["DOCUMENT_ROOT"]."/dianomi/bitrix/")) {
            $errors[] = "Cannot create /dianomi/bitrix/ directory";
        }

        return $errors;
    }

    function InstallDB()
    {
        global $APPLICATION;
        $errors = array();

        // Create iblock type
        $iblockType = new CIBlockType;
        $iblockTypeID = $iblockType->Add(array(
            "SID" => "dianomi",
            "NAME" => "Dianomi Pages",
            "LIST_CODE" => "DIANOMI_PAGES",
            "IN_SECTIONS" => "N",
            "EDIT_FILE_SECTION" => "N",
            "EDIT_NAME" => "Element",
            "LIST_NAME" => "List",
            "SECTION_NAME" => "Section",
            "SECTION_PICTURE" => "N",
            "SECTION_DESCRIPTION" => "N",
            "PAGE_SETTINGS" => "N",
        ));

        if ($iblockTypeID < 0) {
            $errors[] = "Failed to create iblock type: " . $iblockType->LAST_ERROR;
            return $errors;
        }

        // Create iblocks
        $ib = new CIBlock;
        $iblocks = array(
            "page_hero" => array(
                "NAME" => "Hero Section",
                "PROPERTY_CODES" => array(
                    "BADGE_TEXT" => array("USER_TYPE" => "string"),
                    "TITLE" => array("USER_TYPE" => "string"),
                    "DESCRIPTION" => array("USER_TYPE" => "text"),
                    "COUNTER_1" => array("USER_TYPE" => "string"),
                    "COUNTER_2" => array("USER_TYPE" => "string"),
                    "COUNTER_3" => array("USER_TYPE" => "string"),
                    "COUNTER_LABEL_1" => array("USER_TYPE" => "string"),
                    "COUNTER_LABEL_2" => array("USER_TYPE" => "string"),
                    "COUNTER_LABEL_3" => array("USER_TYPE" => "string"),
                    "BENEFITS_LIST" => array("USER_TYPE" => "string"),
                )
            ),
            "page_problems" => array(
                "NAME" => "Problems",
                "PROPERTY_CODES" => array(
                    "ICON" => array("USER_TYPE" => "string"),
                    "TITLE" => array("USER_TYPE" => "string"),
                    "DESCRIPTION" => array("USER_TYPE" => "text"),
                    "ORDER" => array("USER_TYPE" => "integer"),
                )
            ),
            "page_solutions" => array(
                "NAME" => "Solutions",
                "PROPERTY_CODES" => array(
                    "ICON" => array("USER_TYPE" => "string"),
                    "TITLE" => array("USER_TYPE" => "string"),
                    "DESCRIPTION" => array("USER_TYPE" => "text"),
                    "BENEFITS" => array("USER_TYPE" => "string"),
                    "LINK_TEXT" => array("USER_TYPE" => "string"),
                    "LINK_URL" => array("USER_TYPE" => "string"),
                    "BORDER_COLOR" => array("USER_TYPE" => "string"),
                    "ORDER" => array("USER_TYPE" => "integer"),
                )
            ),
            "page_before_after" => array(
                "NAME" => "Before After",
                "PROPERTY_CODES" => array(
                    "BEFORE_TITLE" => array("USER_TYPE" => "string"),
                    "AFTER_TITLE" => array("USER_TYPE" => "string"),
                    "BEFORE_LIST" => array("USER_TYPE" => "string"),
                    "AFTER_LIST" => array("USER_TYPE" => "string"),
                )
            ),
            "page_approach" => array(
                "NAME" => "Approach",
                "PROPERTY_CODES" => array(
                    "STEP_NUMBER" => array("USER_TYPE" => "integer"),
                    "TITLE" => array("USER_TYPE" => "string"),
                    "ORDER" => array("USER_TYPE" => "integer"),
                )
            ),
            "page_about" => array(
                "NAME" => "About Company",
                "PROPERTY_CODES" => array(
                    "DESCRIPTION" => array("USER_TYPE" => "text"),
                    "OFFICE" => array("USER_TYPE" => "string"),
                    "FEATURES" => array("USER_TYPE" => "string"),
                )
            ),
            "page_faq" => array(
                "NAME" => "FAQ",
                "PROPERTY_CODES" => array(
                    "QUESTION" => array("USER_TYPE" => "string"),
                    "ANSWER" => array("USER_TYPE" => "text"),
                    "ORDER" => array("USER_TYPE" => "integer"),
                )
            ),
        );

        foreach ($iblocks as $code => $data) {
            $ibID = $ib->Add(array(
                "IBLOCK_TYPE_ID" => $iblockTypeID,
                "CODE" => $code,
                "NAME" => $data["NAME"],
                "SORT" => "100",
                "ACTIVE" => "Y",
                "LIST_PAGE_URL" => "#CODE#/",
                "DETAIL_PAGE_URL" => "#CODE#/#ELEMENT_CODE#/",
                "SECTION_PAGE_URL" => "#CODE#/section/#SECTION_ID#/",
                "INDEX_ELEMENT" => "Y",
                "INDEX_SECTION" => "Y",
            ));

            if ($ibID < 0) {
                $errors[] = "Failed to create iblock {$code}: " . $ib->LAST_ERROR;
            } else {
                // Add properties
                $prop = new CIBlockProperty;
                foreach ($data["PROPERTY_CODES"] as $propCode => $propData) {
                    $prop->Add(array(
                        "IBLOCK_ID" => $ibID,
                        "CODE" => $propCode,
                        "NAME" => $propCode,
                        "PROPERTY_TYPE" => $propData["USER_TYPE"],
                        "SORT" => "100",
                        "MULTIPLE" => "N",
                    ));
                }
            }
        }

        return $errors;
    }

    function InstallSite()
    {
        global $APPLICATION;
        $errors = array();

        // Create site
        $site = new CSite;
        $siteID = $site->Add(array(
            "CODE" => "dianomi",
            "SITE_DIR" => "/dianomi/",
            "NAME" => "Dianomi",
            "SERVER_NAME" => "s277847.h1n.ru",
            "ACTIVE" => "Y",
            "SORT" => "100",
            "DEF" => "N",
            "LANGUAGE_ID" => "ru",
        ));

        if ($siteID < 0) {
            $errors[] = "Failed to create site: " . $site->LAST_ERROR;
        }

        return $errors;
    }

    function InstallFiles()
    {
        global $APPLICATION;
        $errors = array();

        // Copy site files
        $siteFiles = array(
            "index.php",
            "about.php",
            "contacts.php",
            "bitrix24.php",
            "bitrix24-prices.php",
            "1c-bitrix.php",
            "1c-bitrix-prices.php",
            "business-systems.php",
            "web-systems.php",
            "data-bi.php",
            "project.php",
            "404.php",
            "robots.txt",
            "sitemap.xml",
        );

        foreach ($siteFiles as $file) {
            if (file_exists(__DIR__ . "/../" . $file)) {
                CopyFile(__DIR__ . "/../" . $file, $_SERVER["DOCUMENT_ROOT"] . "/dianomi/" . $file);
            }
        }

        // Copy assets
        CopyDirFile(__DIR__ . "/../css/", $_SERVER["DOCUMENT_ROOT"] . "/dianomi/css/");
        CopyDirFile(__DIR__ . "/../js/", $_SERVER["DOCUMENT_ROOT"] . "/dianomi/js/");
        CopyDirFile(__DIR__ . "/../img/", $_SERVER["DOCUMENT_ROOT"] . "/dianomi/img/");

        return $errors;
    }

    function InstallTemplate()
    {
        global $APPLICATION;
        $errors = array();

        // Copy template files
        CopyDirFile(__DIR__ . "/../templates/dianomi/", $_SERVER["DOCUMENT_ROOT"] . "/dianomi/bitrix/templates/dianomi/");

        // Copy components
        CopyDirFile(__DIR__ . "/../components/dianomi/", $_SERVER["DOCUMENT_ROOT"] . "/dianomi/bitrix/local/components/dianomi/");

        return $errors;
    }

    function UninstallFiles()
    {
        // Delete site files
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/index.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/about.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/contacts.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/bitrix24.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/bitrix24-prices.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/1c-bitrix.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/1c-bitrix-prices.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/business-systems.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/web-systems.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/data-bi.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/project.php");
        DeleteFile($_SERVER["DOCUMENT_ROOT"] . "/dianomi/404.php");

        // Delete directories
        DeleteDirFilesDir($_SERVER["DOCUMENT_ROOT"] . "/dianomi/css/");
        DeleteDirFilesDir($_SERVER["DOCUMENT_ROOT"] . "/dianomi/js/");
        DeleteDirFilesDir($_SERVER["DOCUMENT_ROOT"] . "/dianomi/img/");
    }

    function UninstallDB()
    {
        global $APPLICATION;
        $errors = array();

        // Delete iblocks
        $ib = new CIBlock;
        $iblocks = array("page_hero", "page_problems", "page_solutions", "page_before_after", "page_approach", "page_about", "page_faq");
        foreach ($iblocks as $code) {
            $rsIB = CIBlock::GetList(array(), array("CODE" => $code, "IBLOCK_TYPE_ID" => "dianomi"));
            if ($arIB = $rsIB->Fetch()) {
                $ib->Delete($arIB["ID"]);
            }
        }

        // Delete site
        $site = new CSite;
        $site->Delete("dianomi");

        return $errors;
    }

    function InstallEvents()
    {
        return array();
    }

    function UninstallEvents()
    {
        return array();
    }
}
?>
