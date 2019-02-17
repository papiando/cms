<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class TemplatePlugin extends Addon {
	// Encapsulates the output in the template
	public static function render($html) {
		$_Template = Template::get(Configuration::getParameter('template',Configuration::getDefault('template','default')),"`name`,`@attribute`,`body`");
		if($html) {
			// Render the template
			return preg_replace("/<cubo:content\s*\/>/i",$html,$_Template->body);
		} else {
			return false;
		}
	}
}
?>