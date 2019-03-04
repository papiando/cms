<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Text
 * @version        2.0.4
 * @date           2019-03-03
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

class Text {
	public static function getLanguage() {
		return Language::get(Application::getRouter()->getLanguage());
	}
	
	public static function translate($text,$replacements = []) {
		// Determine language if specified
		$_Language = Language::getLanguage(Application::getRouter()->getLanguage());
		if(!$_Language || $_Language->{'#'} == LANGUAGE_UNDEFINED) {
			// Default to English if language is not defined
			$_Language = Language::getLanguage('english');
		}
		$_Translation = Translation::get($_Language->alpha3.'-'.$text,null,"`language`=".$_Language->{'#'});
		if($_Translation)
			return preg_replace_callback("/\{([^}]+)\}/i",function($matches) use($replacements) { return $replacements[$matches[1]]; },$_Translation->translation);
		else
			return $text;
	}
	
	public static function _($text,$replacements = []) {
		return self::translate($text,$replacements);
	}
	
	public static function plural($property,$count = 'n',$default = null) {
		$language = self::getLanguage();
		$query = "SELECT `title` FROM `translation` WHERE `language`=:language AND `name`=:property LIMIT 1";
		$result = Application::getDB()->loadItem($query,array(':language'=>$language->id,':property'=>$property.'-'.$count));
		if(!$result) {
			$result = Application::getDB()->loadItem($query,array(':language'=>$language->id,':property'=>$property.'-n'));
			if(!$result) {
				$result = Application::getDB()->loadItem($query,array(':language'=>$language->id,':property'=>$property.'-n'));
			}
		}
		return ($result ? $result['title'] : ($default ? $default : $property));
	}
	
	public static function retro($property,$language) {
		$query = "SELECT `name` FROM `translation` WHERE `language`=:language AND `seo`=:property LIMIT 1";
		$result = Application::getDB()->loadItem($query,array(':language'=>$language->id,':property'=>$property));
		return ($result ? $result['name'] : $property);
	}
}
?>