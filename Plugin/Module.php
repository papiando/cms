<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          Module
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Plugin;
use Cubo\Framework\Addon as Addon;

class Module extends Addon {
	// Load module and render output
	public static function loadModule($module,$params) {
		// Read content and parse as if query string; store in _Params
		parse_str(str_replace(',','&',trim($params)),$Params);
		$module = __CUBO__.'\\Module\\'.ucfirst($module);
		if(class_exists($module)) {
			$Module = new $module;
			if($Module) {
				return $Module::render((object)$Params);
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
			return false;
		}
	}
}
?>