<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class LogoModule extends Addon {
	// Render login form
	public static function render($_Params) {
		$html = '<a class="navbar-brand" href="<cubo:param name=\'route\' />">';
		if(!empty(Configuration::getParameter('brand-logo'))) {
			$html .= '<img class="brand-logo '.($_Params->{'brand-logo'} ?? '').'" src="'.Configuration::getParameter('brand-logo').'" />';
		}
		if(!empty(Configuration::getParameter('brand-name'))) {
			$html .= '<span class="brand-name '.($_Params->{'brand-name'} ?? '').'">'.Configuration::getParameter('brand-name').'</span>';
		}
		$html .= '</a>';
		return $html;				
	}
}
?>