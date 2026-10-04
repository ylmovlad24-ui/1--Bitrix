<?php
if (!defined("b_xrona_included")) define("b_xrona_included",1);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_heading.php");

$sitename = GetOption("main", "sitename");
$siteID = Trim($WIZARD_SITE_ID);
if ($siteID == "") $siteID = "s1";
$siteLangID = Trim($WIZARD_SITE_LANG);
if ($siteLangID == "") $siteLangID = "ru";
$sitePath = Trim($WIZARD_SITE_DIR);
if ($sitePath == "") $sitePath = "/dianomi/";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_site.php");
?>
<tr>
    <td class="value">ID сайта:</td>
    <td class="name">
        <input type="text" name="WIZARD_SITE_ID" size="17" value="<?=$siteID?>">
    </td>
</tr>
<tr>
    <td class="value">Код языка:</td>
    <td class="name">
        <input type="text" name="WIZARD_SITE_LANG" size="17" value="<?=$siteLangID?>">
        <font size="1">(ru, en, etc.)</font>
    </td>
</tr>
<tr>
    <td class="value">Каталог сайта:</td>
    <td class="name">
        <input type="text" name="WIZARD_SITE_DIR" size="17" value="<?=$sitePath?>">
    </td>
</tr>
<tr>
    <td class="value">Доменное имя:</td>
    <td class="name">
        <input type="text" name="WIZARD_SITE_SERVER_NAME" size="17" value="s277847.h1n.ru<?=$sitePath?>">
    </td>
</tr>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_site_end.php"); ?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_heading.php");
?>
<tr>
    <td colspan="2" class="heading">Создание инфоблоков</td>
</tr>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_section_end.php"); ?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_heading.php");
?>
<tr>
    <td colspan="2" class="heading">Копирование файлов</td>
</tr>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_section_end.php"); ?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_heading.php");
?>
<tr>
    <td colspan="2" class="heading">Привязка шаблона</td>
</tr>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/wizard_section_end.php"); ?>
