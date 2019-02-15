<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ModulePlugin extends Addon {
	// Load module and render output
	public static function loadModule($module) {
		$module = __CUBO__.'\\'.$module.'module';
		if(class_exists($module)) {
			$_Module = new $module;
			if($_Module) {
				return $_Module::render();
			} else
				return false;
		} else {
			// For the moment, skip any errors if the module does not exist
		}
		return false;
	}
	
	// Replaces name tags in content by parameter values
	public static function render($html) {
		if($html) {
			return preg_replace_callback("/<cubo:module\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return self::loadModule($matches[1]); },$html);
		} else {
			return $html;
		}
	}
}
?>