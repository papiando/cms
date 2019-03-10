<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          Template
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Plugin;
use Cubo\Framework\Addon as Addon;
use Cubo\Framework\Configuration as Configuration;
use Cubo\Model\Template as SiteTemplate;

class Template extends Addon {
	// Encapsulates the output in the template
	public static function render($html) {
		$Template = SiteTemplate::get(Configuration::getParameter('template',Configuration::getDefault('template','default')),"`name`,`@attribute`,`body`");
		if($html) {
			// Render the template
			return preg_replace("/<cubo:content\s*\/>/i",$html,$Template->body);
		} else {
			return false;
		}
	}
}
?>