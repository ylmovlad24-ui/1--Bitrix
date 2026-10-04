<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/wizard/dianomi/lang/".LANGUAGE_ID."/wizard.php");

class DianomiWizard extends CWizard
{
    public $installDir;

    function __construct(&$params)
    {
        global $Wizard;

        $this->installDir = $Wizard["ID"];
        parent::__construct($params);
    }

    function Validate()
    {
        global $WIZARD_SITE_ID, $WIZARD_SITE_LANG, $WIZARD_SITE_DIR, $WIZARD_SITE_SERVER_NAME;

        $this->SetError($WIZARD_SITE_ID=="" ? GetMessage("WIZARD_EMPTY_SITE_ID") : "");
        $this->SetError($WIZARD_SITE_LANG=="" ? GetMessage("WIZARD_EMPTY_SITE_LANG") : "");
        $this->SetError($WIZARD_SITE_DIR=="" ? GetMessage("WIZARD_EMPTY_SITE_DIR") : "");

        if ($this->GetErrorCount()>0)
            return false;

        return true;
    }

    function InstallVars()
    {
        global $WIZARD_SITE_ID, $WIZARD_SITE_LANG, $WIZARD_SITE_DIR, $WIZARD_SITE_SERVER_NAME;

        $WIZARD_SITE_ID = trim($WIZARD_SITE_ID);
        $WIZARD_SITE_LANG = trim($WIZARD_SITE_LANG);
        $WIZARD_SITE_DIR = trim($WIZARD_SITE_DIR);
        $WIZARD_SITE_SERVER_NAME = trim($WIZARD_SITE_SERVER_NAME);

        if (substr($WIZARD_SITE_DIR, 0, 1) != "/") $WIZARD_SITE_DIR = "/".$WIZARD_SITE_DIR;
        if (substr($WIZARD_SITE_DIR, -1) == "/") $WIZARD_SITE_DIR = substr($WIZARD_SITE_DIR, 0, strlen($WIZARD_SITE_DIR)-1);

        // Save site parameters
        COption::SetOptionString("main", "wizard_dianomi_locate_to_server_name", $WIZARD_SITE_SERVER_NAME, "Сайт Dianomi");
        COption::SetOptionString("main", "wizard_dianomi_site_dir", $WIZARD_SITE_DIR, "Сайт Dianomi");
    }

    function InstallDB($options = array())
    {
        global $APPLICATION;

        IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/wizard/dianomi/lang/".LANGUAGE_ID."/install.php");

        // Install iblocks
        $errors = $this->InstallIBlocks();
        if (count($errors) > 0) {
            $APPLICATION->ThrowException(implode("\n", $errors));
            return false;
        }

        return true;
    }

    function InstallIBlocks()
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
        global $APPLICATION, $WIZARD_SITE_ID, $WIZARD_SITE_LANG, $WIZARD_SITE_DIR, $WIZARD_SITE_SERVER_NAME;

        $errors = array();

        // Create site
        $site = new CSite;
        $siteID = $site->Add(array(
            "CODE" => "dianomi",
            "SITE_DIR" => $WIZARD_SITE_DIR,
            "NAME" => "Dianomi",
            "SERVER_NAME" => $WIZARD_SITE_SERVER_NAME,
            "ACTIVE" => "Y",
            "SORT" => "100",
            "DEF" => "N",
            "LANGUAGE_ID" => $WIZARD_SITE_LANG,
        ));

        if ($siteID < 0) {
            $errors[] = "Failed to create site: " . $site->LAST_ERROR;
        }

        return $errors;
    }

    function InstallFiles()
    {
        global $APPLICATION, $WIZARD_SITE_DIR;

        $errors = array();
        $wizardDir = dirname(__FILE__);
        $solutionDir = $wizardDir . "/../../.."; // Go up to wizard root

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
            $wizardFile = $wizardDir . "/../" . $file;
            if (file_exists($wizardFile)) {
                CopyFile($wizardFile, $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . $file);
            }
        }

        // Copy assets
        CopyDirFile($wizardDir . "/css/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "css/");
        CopyDirFile($wizardDir . "/js/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "js/");
        CopyDirFile($wizardDir . "/img/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "img/");

        return $errors;
    }

    function InstallTemplate()
    {
        global $APPLICATION, $WIZARD_SITE_DIR;

        $errors = array();
        $wizardDir = dirname(__FILE__);

        // Copy template files
        CopyDirFile($wizardDir . "/templates/dianomi/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/templates/dianomi/");

        // Copy components
        CopyDirFile($wizardDir . "/components/dianomi/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/local/components/dianomi/");

        // Copy menu component
        CopyDirFile($wizardDir . "/components/bitrix/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/local/components/bitrix/");

        return $errors;
    }

    function InstallMenu()
    {
        global $APPLICATION;

        $menuItems = array(
            array(
                "TEXT" => GetMessage("WIZARD_MENU_HOME"),
                "TITLE" => GetMessage("WIZARD_MENU_HOME_TITLE"),
                "SORT" => 100,
                "URL" => "/",
            ),
            array(
                "TEXT" => GetMessage("WIZARD_MENU_SOLUTIONS"),
                "TITLE" => GetMessage("WIZARD_MENU_SOLUTIONS_TITLE"),
                "SORT" => 200,
                "URL" => "/business-systems.php",
                "CHILD_ITEMS" => array(
                    array("TEXT" => "Системы управления бизнесом", "URL" => "/business-systems.php", "SORT" => 100),
                    array("TEXT" => "Битрикс24", "URL" => "/bitrix24.php", "SORT" => 200),
                    array("TEXT" => "Тарифы Битрикс24", "URL" => "/bitrix24-prices.php", "SORT" => 300),
                    array("TEXT" => "Веб-системы", "URL" => "/web-systems.php", "SORT" => 400),
                    array("TEXT" => "1С-Битрикс", "URL" => "/1c-bitrix.php", "SORT" => 500),
                    array("TEXT" => "Тарифы 1С-Битрикс", "URL" => "/1c-bitrix-prices.php", "SORT" => 600),
                    array("TEXT" => "Данные и BI-аналитика", "URL" => "/data-bi.php", "SORT" => 700),
                ),
            ),
            array(
                "TEXT" => GetMessage("WIZARD_MENU_ABOUT"),
                "TITLE" => GetMessage("WIZARD_MENU_ABOUT_TITLE"),
                "SORT" => 300,
                "URL" => "/about.php",
            ),
            array(
                "TEXT" => GetMessage("WIZARD_MENU_CONTACTS"),
                "TITLE" => GetMessage("WIZARD_MENU_CONTACTS_TITLE"),
                "SORT" => 400,
                "URL" => "/contacts.php",
            ),
        );

        // Save menu
        CMenu::SaveMenu($menuItems, "main", "/");

        return array();
    }

    function InstallEvents()
    {
        return array();
    }

    function DoActions($params)
    {
        global $WIZARD_SITE_DIR;

        // Make directory if not exists
        CheckDirPath($_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR);

        // Copy all wizard files to site
        $wizardDir = dirname(__FILE__);
        
        // Copy PHP files
        $files = glob($wizardDir . "/*.php");
        foreach ($files as $file) {
            if (basename($file) != "wizard.php" && basename($file) != "index.php") {
                CopyFile($file, $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . basename($file));
            }
        }

        // Copy directories
        CopyDirFile($wizardDir . "/css/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "css/");
        CopyDirFile($wizardDir . "/js/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "js/");
        CopyDirFile($wizardDir . "/img/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "img/");
        CopyDirFile($wizardDir . "/partials/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "partials/");

        // Copy template
        if (is_dir($wizardDir . "/templates")) {
            CopyDirFile($wizardDir . "/templates/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/templates/");
        }

        // Copy components
        if (is_dir($wizardDir . "/components")) {
            CopyDirFile($wizardDir . "/components/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/local/components/");
        }
    }

    function InstallSiteTemplate()
    {
        global $APPLICATION, $WIZARD_SITE_ID, $WIZARD_SITE_DIR;

        $errors = array();

        // Copy template files
        $wizardDir = dirname(__FILE__);
        CopyDirFile($wizardDir . "/templates/dianomi/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/templates/dianomi/");

        // Copy components
        CopyDirFile($wizardDir . "/components/dianomi/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/local/components/dianomi/");
        CopyDirFile($wizardDir . "/components/bitrix/", $_SERVER["DOCUMENT_ROOT"] . $WIZARD_SITE_DIR . "bitrix/local/components/bitrix/");

        // Bind template to site
        $site = new CSite;
        $rsSite = CSite::GetList($by="sort", $order="desc", array("CODE" => "dianomi"));
        if ($arSite = $rsSite->Fetch()) {
            // Template is already bound via site CODE
        }

        return $errors;
    }

    function Install()
    {
        global $APPLICATION;

        $this->InstallVars();
        $this->InstallDB();
        $this->InstallSite();
        $this->InstallFiles();
        $this->InstallTemplate();
        $this->InstallMenu();
        $this->InstallEvents();
        $this->DoActions($this->GetVars());
        $this->InstallSiteTemplate();

        $APPLICATION->ThrowException(GetMessage("WIZARD_INSTALL_COMPLETE"));
    }

    function Uninstall()
    {
        // Placeholder for uninstall
    }
}
?>
