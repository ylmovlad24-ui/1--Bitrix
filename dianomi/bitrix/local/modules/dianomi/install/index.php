<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;

class dianomi extends CModule
{
    public $MODULE_ID = "dianomi";
    public $MODULE_NAME = "Dianomi Components";
    public $MODULE_DESCR = "Компоненты для сайта Dianomi";
    public $MODULE_VERSION;
    public $MODULE_VERSION_COMMENT;
    public $MODULE_PATH;
    
    public function __construct()
    {
        $arModuleVersion = array();
        $this->loadFile("classes.php");
        
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_COMMENT = $arModuleVersion["VERSION_COMMENT"];
        $this->MODULE_PATH = substr($_SERVER["DOCUMENT_ROOT"], 0, strlen($_SERVER["DOCUMENT_ROOT"]) - strlen(dirname(__FILE__)));
        
        IncludeModuleLangFile(__FILE__);
    }
    
    public function installFiles()
    {
        // Установка компонентов
        $dst = "local/components/dianomi";
        $src = "local/modules/dianomi/install/components/dianomi";
        
        if (file_exists($dst)) {
            $this->deleteDir($dst);
        }
        
        $this->copyDir($src, $dst);
    }
    
    public function installDB()
    {
        // Создание инфоблоков
        $this->createIblocks();
    }
    
    public function uninstallFiles()
    {
        // Удаление компонентов
        $dst = "local/components/dianomi";
        if (file_exists($dst)) {
            $this->deleteDir($dst);
        }
    }
    
    public function uninstallDB()
    {
        // Удаление инфоблоков
        $this->deleteIblocks();
    }
    
    public function install()
    {
        $this->installFiles();
        $this->installDB();
        ModuleManager::registerModule($this->MODULE_ID);
    }
    
    public function uninstall()
    {
        ModuleManager::unregisterModule($this->MODULE_ID);
        $this->uninstallFiles();
        $this->uninstallDB();
    }
    
    protected function createIblocks()
    {
        // Создание инфоблоков через API
        // (реализация аналогична install_iblocks.php)
    }
    
    protected function deleteIblocks()
    {
        // Удаление инфоблоков
    }
    
    protected function copyDir($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . "/" . $file)) {
                    $this->copyDir($src . "/" . $file, $dst . "/" . $file);
                } else {
                    copy($src . "/" . $file, $dst . "/" . $file);
                }
            }
        }
        closedir($dir);
    }
    
    protected function deleteDir($dir)
    {
        $dir = opendir($dir);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($dir . "/" . $file)) {
                    $this->deleteDir($dir . "/" . $file);
                } else {
                    unlink($dir . "/" . $file);
                }
            }
        }
        closedir($dir);
        rmdir($dir);
    }
}
