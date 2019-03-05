<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Configuration
 * @version        2.0.4
 * @date           2019-03-05
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

// Define global constants
define('ACCESS_ADMIN',5);
define('ACCESS_ANY',-1);
define('ACCESS_GUEST',3);
define('ACCESS_NONE',0);
define('ACCESS_PRIVATE',4);
define('ACCESS_PUBLIC',1);
define('ACCESS_REGISTERED',2);
define('CATEGORY_ANY',-1);
define('CATEGORY_NONE',0);
define('CATEGORY_UNDEFINED',1);
define('LANGUAGE_ANY',-1);
define('LANGUAGE_UNDEFINED',1);
define('ROLE_ADMINISTRATOR',6);
define('ROLE_ANY',-1);
define('ROLE_AUTHOR',2);
define('ROLE_EDITOR',3);
define('ROLE_GUEST',0);
define('ROLE_MANAGER',5);
define('ROLE_PUBLISHER',4);
define('ROLE_USER',1);
define('STATUS_ANY',-1);
define('STATUS_PUBLISHED',1);
define('STATUS_SYSTEM',0);
define('STATUS_TRASHED',3);
define('STATUS_UNPUBLISHED',2);
define('USER_ANY',-1);
define('USER_NOBODY',0);
define('USER_SYSTEM',1);

// Global constants for settings
define('SETTING_ABOVECONTENT',1);
define('SETTING_ABOVETITLE',2);
define('SETTING_AUTHOR',1);
define('SETTING_BELOWCONTENT',4);
define('SETTING_BELOWTITLE',3);
define('SETTING_CREATEDDATE',1);
define('SETTING_EDITOR',2);
define('SETTING_FLOATLEFT',5);
define('SETTING_FLOATRIGHT',6);
define('SETTING_GLOBAL',-1);
define('SETTING_HIDE',0);
define('SETTING_MODIFIEDDATE',2);
define('SETTING_NO',0);
define('SETTING_OFF',0);
define('SETTING_ON',1);
define('SETTING_PARAGRAPH',1);
define('SETTING_PUBLISHEDDATE',3);
define('SETTING_PUBLISHER',3);
define('SETTING_SHOW',1);
define('SETTING_TENLINES',2);
define('SETTING_YES',1);

final class Configuration {
	private static $_Configuration;
	
	// Constructor of Configuration class loads configuration
	//   Modify parameter if the configuration file should be named differently
	public function __construct($file = ".configuration.php") {
		self::load($file);
		empty(self::$_Configuration->_Attribute) && self::$_Configuration->_Attribute = [];
		empty(self::$_Configuration->_Default) && self::$_Configuration->_Default = [];
		empty(self::$_Configuration->_Parameter) && self::$_Configuration->_Parameter = [];
		empty(self::$_Configuration->_Parameter) && self::$_Configuration->_Script = [];
		empty(self::$_Configuration->_Parameter) && self::$_Configuration->_Stylesheet = [];
	}
	
	// Add script
	public static function addScript($script) {
		self::$_Configuration->_Script[] = $script;
	}
	
	// Add stylesheet
	public static function addStylesheet($stylesheet) {
		self::$_Configuration->_Stylesheet[] = $stylesheet;
	}
	
	// Retrieve configuration setting
	public static function get($property,$default = null) {
		return self::$_Configuration->$property ?? $default ?? null;
	}
	
	// Retrieve attribute setting
	public static function getAttribute($property,$default = null) {
		return self::$_Configuration->_Attribute[$property] ?? $default ?? null;
	}
	
	// Retrieve default setting
	public static function getDefault($property,$default = null) {
		return self::$_Configuration->_Default[$property] ?? $default ?? null;
	}
	
	// Retrieve parameter
	public static function getParameter($property,$default = null) {
		return self::$_Configuration->_Parameter[$property] ?? $default ?? null;
	}
	
	// Retrieve list of scripts
	public static function getScripts() {
		return self::$_Configuration->_Script ?? [];
	}
	
	// Retrieve list of stylesheets
	public static function getStylesheets() {
		return self::$_Configuration->_Stylesheet ?? [];
	}
	
	// Load settings from configuration file
	private static function load($file) {
		self::$_Configuration = (object)[];
		if(file_exists(__ROOT__.DS.$file))
			include_once(__ROOT__.DS.$file);
	}
	
	// Store configuration setting
	public static function set($property,$value) {
		return self::$_Configuration->$property = $value;
	}
	
	// Store attribute setting
	public static function setAttribute($property,$value) {
		return self::$_Configuration->_Attribute[$property] = $value;
	}
	
	// Store default setting
	public static function setDefault($property,$value) {
		return self::$_Configuration->_Default[$property] = $value;
	}
	
	// Store parameter
	public static function setParameter($property,$value) {
		return self::$_Configuration->_Parameter[$property] = $value;
	}
}
?>