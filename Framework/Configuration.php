<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Configuration
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;

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
	private static $Configuration;
	
	// Constructor of Configuration class loads configuration
	//   Modify parameter if the configuration file should be named differently
	public function __construct($file = ".config.json") {
		// Load configuration file
		self::load($file);
		// Create empty arrays if not yet defined in configuration file
		empty(self::$Configuration->Attribute) && self::$Configuration->Attribute = [];
		empty(self::$Configuration->Default) && self::$Configuration->Default = [];
		empty(self::$Configuration->Parameter) && self::$Configuration->Parameter = [];
		empty(self::$Configuration->Script) && self::$Configuration->Script = [];
		empty(self::$Configuration->Stylesheet) && self::$Configuration->Stylesheet = [];
	}
	
	// Add script to be loaded
	public static function addScript($script) {
		self::$Configuration->Script[] = $script;
	}
	
	// Add stylesheet to be loaded
	public static function addStylesheet($stylesheet) {
		self::$Configuration->Stylesheet[] = $stylesheet;
	}
	
	// Retrieve configuration setting
	public static function get($property,$default = null) {
		return self::$Configuration->$property ?? $default ?? null;
	}
	
	// Retrieve attribute setting
	public static function getAttribute($property,$default = null) {
		return self::$Configuration->Attribute[$property] ?? $default ?? null;
	}
	
	// Retrieve default setting
	public static function getDefault($property,$default = null) {
		return self::$Configuration->Default[$property] ?? $default ?? null;
	}
	
	// Retrieve parameter
	public static function getParameter($property,$default = null) {
		return self::$Configuration->Parameter[$property] ?? $default ?? null;
	}
	
	// Retrieve list of scripts
	public static function getScripts() {
		return self::$Configuration->Script ?? [];
	}
	
	// Retrieve list of stylesheets
	public static function getStylesheets() {
		return self::$Configuration->Stylesheet ?? [];
	}
	
	// Load settings from configuration file
	private static function load($file) {
		// Preset configuration container
		self::$Configuration = (object)[];
		// Detect if file exists
		if(file_exists(__ROOT__.DS.$file)) {
			if(substr($file,-4) == '.php')
				// Assume configuration is loaded via PHP
				include_once(__ROOT__.DS.$file);
			elseif(substr($file,-5) == '.json')
				// Assume configuration is kept in JSON format
				self::$Configuration = json_decode(file_get_contents($file));
			else
				// Ignore for the moment, but other formats like XML could be added here
				;
		}
	}
	
	// Store configuration setting
	public static function set($property,$value) {
		return self::$Configuration->$property = $value;
	}
	
	// Store attribute setting
	public static function setAttribute($property,$value) {
		return self::$Configuration->Attribute[$property] = $value;
	}
	
	// Store default setting
	public static function setDefault($property,$value) {
		return self::$Configuration->Default[$property] = $value;
	}
	
	// Store parameter
	public static function setParameter($property,$value) {
		return self::$Configuration->Parameter[$property] = $value;
	}
}
?>