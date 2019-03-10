<?php
/**
 * @application    Cubo CMS
 * @type           Module
 * @class          Logo
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Module;
use Cubo\Framework\Addon as Addon;
use Cubo\Framework\Configuration as Configuration;

class Logo extends Addon {
	// Render logo
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