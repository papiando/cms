<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Locale {
	protected static $language;
	protected static $timezone;
	
	// Detect browser language
	public static function detectLanguage() {
		return self::$language = parent::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	}
	
	// Returns current time for timezone
	public static function getCurrentTime($timezone = null) {
		empty($timezone) && $timezone = self::$timezone;
		return new \DateTime('now', new \DateTimeZone($timezone));
	}
	
	// Return current language
	public static function getLanguage() {
		return self::$language ?? self::detectLanguage();
	}
	
	// Returns current time zone
	public static function getTimezone() {
		return self::$timezone;
	}
	
	// Returns true if language identifier is valid
	public static function isValidLanguage($language = null) {
		return true;
	}
	
	// Returns true if time zone identifier is valid
	public static function isValidTimezone($timezone = null) {
		return in_array($timezone ?? self::$timezone,\DateTimeZone::listIdentifiers());
	}
	
	// Set current language
	public static function setLanguage($language) {
		if(self::isValidLanguage($language))
			return self::$language = $language;
		else
			return null;
	}
	
	// Set current time zone
	public static function setTimezone($timezone) {
		if(self::isValidTimezone($timezone))
			return self::$timezone = $timezone;
		else
			return null;
	}
	
	
	
	
	
	
	
	public static function getLanguage() {
		return self::$language = parent::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	}
	
	public static function getLocale() {
		
	}
	
	// Sets locale 
	public static function setLocale($locale) {
		
	}
}
?>