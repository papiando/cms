<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

// Define global constants
define('ACCESS_ANY',-1);
define('ACCESS_GUEST',3);
define('ACCESS_NONE',0);
define('ACCESS_PRIVATE',4);
define('ACCESS_PUBLIC',1);
define('ACCESS_REGISTERED',2);
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
define('SETTING_ABOVECONTENT',4);
define('SETTING_ABOVETITLE',2);
define('SETTING_AUTHOR',4);
define('SETTING_BELOWCONTENT',5);
define('SETTING_BELOWTITLE',3);
define('SETTING_CREATEDDATE',4);
define('SETTING_EDITOR',5);
define('SETTING_FLOATLEFT',6);
define('SETTING_FLOATRIGHT',7);
define('SETTING_GLOBAL',-1);
define('SETTING_HIDE',2);
define('SETTING_MODIFIEDDATE',5);
define('SETTING_NO',0);
define('SETTING_OFF',1);
define('SETTING_ON',0);
define('SETTING_PARAGRAPH',3);
define('SETTING_PUBLISHEDDATE',6);
define('SETTING_PUBLISHER',6);
define('SETTING_SHOW',3);
define('SETTING_TENLINES',4);
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
	}
	
	// Load settings from configuration file
	private static function load($file) {
		self::$_Configuration = (object)[];
		if(file_exists(__ROOT__.DS.$file))
			include_once(__ROOT__.DS.$file);
	}
	
	// Retrieve configuration setting
	public static function get($property,$default = null) {
		return self::$_Configuration->$property ?? $default ?? null;
	}
	
	// Store configuration setting
	public static function set($property,$value) {
		return self::$_Configuration->$property = $value;
	}
	
	// Retrieve attribute setting
	public static function getAttribute($property,$default = null) {
		return self::$_Configuration->_Attribute[$property] ?? $default ?? null;
	}
	
	// Store attribute setting
	public static function setAttribute($property,$value) {
		return self::$_Configuration->_Attribute[$property] = $value;
	}
	
	// Retrieve default setting
	public static function getDefault($property,$default = null) {
		return self::$_Configuration->_Default[$property] ?? $default ?? null;
	}
	
	// Store default setting
	public static function setDefault($property,$value) {
		return self::$_Configuration->_Default[$property] = $value;
	}
	
	// Retrieve parameter
	public static function getParameter($property,$default = null) {
		return self::$_Configuration->_Parameter[$property] ?? $default ?? null;
	}
	
	// Store parameter
	public static function setParameter($property,$value) {
		return self::$_Configuration->_Parameter[$property] = $value;
	}
	
	// Retrieve route setting
	public static function getRoute($property,$default = null) {
		return self::$_Configuration->_Route[$property] ?? $default ?? null;
	}
}
?>