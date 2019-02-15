<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContentPlugin extends Addon {
	// Replaces name tags in content by parameter values
	public static function render($html) {
		if($html) {
			return preg_replace_callback("/<cubo:param\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return Configuration::getParameter($matches[1]); },$html);
		} else {
			return $html;
		}
	}
}
?>