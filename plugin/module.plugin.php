<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ModulePlugin extends Addon {
	// Load module and render output
	public static function loadModule($module,$params) {
		// Read content and parse as if query string; store in _Params
		parse_str(str_replace(',','&',trim($params)),$_Params);
		$module = __CUBO__.'\\'.$module.'module';
		if(class_exists($module)) {
			$_Module = new $module;
			if($_Module) {
				return $_Module::render((object)$_Params);
			} else
				return false;
		} else {
			// For the moment, skip any errors if the module does not exist
		}
		return false;
	}
	
	// Replaces name tags in content by parameter values
	//   Tags should match: <cubo:module name="module-name" content="param1=first,param2=second" />
	public static function render($html) {
		if($html) {
			return preg_replace_callback("/<cubo:module\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s+content\s*=\s*[\'\"]([^\'\"]*)[\'\"]\s*\/>/i",function($matches) { return self::loadModule($matches[1],$matches[2]); },$html);
		} else {
			return $html;
		}
	}
}
?>