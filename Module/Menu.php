<?php
/**
 * @application    Cubo CMS
 * @type           Module
 * @class          Menu
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Module;
use Cubo\Framework\Addon as Addon;
use Cubo\Framework\Configuration as Configuration;
use Cubo\Framework\Session as Session;
use Cubo\Model\Menu as MainMenu;
use Cubo\Model\Option as Option;

class Menu extends Addon {
	// Returns filter for view permission
	private static function requireViewPermission() {
		$filter = [];
		if(Session::isAuthor())
			$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.','.ACCESS_ADMIN.')';
		elseif(Session::isRegistered())
			$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.')';
		else
			$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_GUEST.')';
		$filter[] = "`status`=".STATUS_PUBLISHED;
		return implode(' AND ',$filter) ?? '1';
	}
	
	// Show options
	public static function showOptions($Menu) {
		$html = '';
		if($Menu && !empty($Menu->{'@option'})) {
			$options = json_decode($Menu->{'@option'});
			foreach($options as $option) {
				$Option = Option::get($option,"`@attribute`,`@option`,accesslevel,title",self::requireViewPermission());
				if($Option) {
					$Attribute = json_decode($Option->{'@attribute'});
					empty($html) && $html = '<ul '.(isset($Menu->name) ? 'id="'.$Menu->name.'" ' : '').'class="navbar-nav">';
					$html .= '<li class="nav-item">';
					if(isset($Attribute->uri)) {				// Internal link
						$html .= '<a class="nav-link" href="'.$Attribute->uri.'">'.$Option->title.'</a>';
					} elseif(isset($Attribute->url)) {			// External link
						$html .= '<a class="nav-link" href="'.$Attribute->url.'">'.$Option->title.'</a>';
					} elseif(!empty($Option->{'@option'})) {
						$html .= self::showOptions($Option);
					} else {
						$html .= $Option->title;
					}
					$html .= '</li>';
				}
			}
		}
		!empty($html) && $html .= '</ul>';
		return $html;
	}
	// Render menu
	public static function render($Params) {
		// Check if show-menu-module is turned on
		if(!Configuration::getParameter('show-menu-module',SETTING_YES))
			return false;
		// Now render the rest
		if(isset($Params->menu)) {
			$menu = $Params->menu;
		} else {
			$menu = Configuration::getDefault('menu','mainmenu');
		}
		$html = '';
		$Menu = MainMenu::get($menu,"`name`,`@attribute`,`@option`,accesslevel,title",1);
		if($Menu) {
			$html .= self::showOptions($Menu);
		}
		return $html;				
	}
}
?>