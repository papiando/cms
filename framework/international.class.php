<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class International {
	protected static $countryAPI = "https://cubo-cms.com/api/country/all";
	protected static $currencyAPI = "https://cubo-cms.com/api/currency/all";
	protected static $languageAPI = "https://cubo-cms.com/api/language/all";
	protected static $timezoneAPI = "https://cubo-cms.com/api/timezone/all";
	protected static $language;
	protected static $timezone;
	
	// Detect browser language
	public static function detectLanguage() {
		return self::$language = parent::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	}
	
	// Returns list of currencies from API
	public static function getCurrencyList($api = null) {
		$json = file_get_contents($api ?? self::$currencyAPI);
		return json_decode($json);
	}
	
	// Returns current time for timezone
	public static function getCurrentTime($timezone = null) {
		empty($timezone) && $timezone = self::$timezone;
		return new \DateTime('now', new \DateTimeZone($timezone));
	}
	
	// Returns list of countries from API
	public static function getCountryList($api = null) {
		$json = file_get_contents($api ?? self::$countryAPI);
		return json_decode($json);
	}
	
	// Return current language
	public static function getLanguage() {
		return self::$language ?? self::detectLanguage();
	}
	
	// Returns list of languages from API
	public static function getLanguageList($api = null) {
		$json = file_get_contents($api ?? self::$languageAPI);
		return json_decode($json);
	}
	
	// Returns current time zone
	public static function getTimezone() {
		return self::$timezone;
	}
	
	// Returns list of time zones from API
	public static function getTimezoneList($api = null) {
		$json = file_get_contents($api ?? self::$timezoneAPI);
		return json_decode($json);
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
}
?>