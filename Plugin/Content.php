<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          Content
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Plugin;
use Cubo\Framework\Addon as Addon;
use Cubo\Framework\Configuration as Configuration;

class Content extends Addon {
	// Replaces name tags in content by parameter values
	public static function render($html) {
		if($html) {
			return preg_replace_callback("/<cubo:param\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return Configuration::getParameter($matches[1]); },$html);
		} else {
			return false;
		}
	}
}
?>