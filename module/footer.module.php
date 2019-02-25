<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class FooterModule extends Addon {
	// Render footer
	public static function render($_Params) {
		$html = '<span class="navbar-nav navbar-text m-auto text-center">';
		$html .= '&copy; '.date("Y").' <a class="nav-link d-inline" href="'.Configuration::getParameter('base-url').'">';
		$html .= Configuration::getParameter('brand-name',Configuration::getParameter('site-name','Cubo CMS'));
		$html .= '</a>';
		$html .= '</span>';
		return $html;				
	}
}
?>