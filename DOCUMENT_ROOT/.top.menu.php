<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

return array(
	"items" => array(
		array(
			"TEXT" => "Главная",
			"LINK" => "/index.php",
			"PAGE_ID" => "index",
		),
		array(
			"TEXT" => "Решения",
			"LINK" => "/business-systems/",
			"PAGE_ID" => "business-systems",
			"MORE_LINKS" => array(
				array("TEXT" => "Системы управления бизнесом", "LINK" => "/business-systems/"),
				array("TEXT" => "Веб-системы", "LINK" => "/web-systems/"),
				array("TEXT" => "Данные и BI-аналитика", "LINK" => "/data-bi/"),
				array("TEXT" => "ИИ и чат-боты", "LINK" => "/ai-bots/"),
			),
		),
		array(
			"TEXT" => "1С-Битрикс",
			"LINK" => "/1c-bitrix/",
			"PAGE_ID" => "1c-bitrix",
			"MORE_LINKS" => array(
				array("TEXT" => "Веб-системы", "LINK" => "/1c-bitrix/"),
				array("TEXT" => "Тарифы", "LINK" => "/1c-bitrix-prices/"),
				array("TEXT" => "Интеграция с 1С", "LINK" => "/integrations/"),
				array("TEXT" => "Внедрение", "LINK" => "/project/"),
			),
		),
		array(
			"TEXT" => "Битрикс24",
			"LINK" => "/bitrix24/",
			"PAGE_ID" => "bitrix24",
			"MORE_LINKS" => array(
				array("TEXT" => "Облачный Битрикс24", "LINK" => "/bitrix24/"),
				array("TEXT" => "Коробочный Битрикс24", "LINK" => "/bitrix24-on-premise/"),
				array("TEXT" => "Тарифы Битрикс24", "LINK" => "/bitrix24-prices/"),
			),
		),
		array(
			"TEXT" => "Как работаем",
			"LINK" => "/approach/",
			"PAGE_ID" => "approach",
		),
		array(
			"TEXT" => "О Dianomi",
			"LINK" => "/about/",
			"PAGE_ID" => "about",
		),
	),
);
