<?php
/**
 * @application    Cubo CMS
 * @type           Module
 * @class          Footer
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Module;
use Cubo\Framework\Addon as Addon;
use Cubo\Framework\Configuration as Configuration;

class Footer extends Addon {
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