<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class MenuModule extends Addon {
	// Returns filter for view permission
	private static function requireViewPermission() {
		$filter = [];
		if(Session::isAdmin())
			$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.','.ACCESS_ADMIN.')';
		elseif(Session::isRegistered())
			$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.')';
		else
			$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_GUEST.')';
		$filter[] = "`status`=".STATUS_PUBLISHED;
		return implode(' AND ',$filter) ?? '1';
	}
	
	// Show options
	public static function showOptions($_Menu) {
		$html = '';
		if($_Menu && !empty($_Menu->{'@option'})) {
			$options = json_decode($_Menu->{'@option'});
			foreach($options as $option) {
				$_Option = Option::get($option,"`@attribute`,`@option`,accesslevel,title",self::requireViewPermission());
				if($_Option) {
					$_Attribute = json_decode($_Option->{'@attribute'});
					empty($html) && $html = '<ul class="navbar-nav">';
					$html .= '<li class="nav-item">';
					if(isset($_Attribute->uri)) {				// Internal link
						$html .= '<a class="nav-link" href="'.$_Attribute->uri.'">'.$_Option->title.'</a>';
					} elseif(isset($_Attribute->url)) {			// External link
						$html .= '<a class="nav-link" href="'.$_Attribute->url.'">'.$_Option->title.'</a>';
					} elseif(!empty($_Option->{'@option'})) {
						$html .= self::showOptions($_Option);
					} else {
						$html .= $_Option->title;
					}
					$html .= '</li>';
				}
			}
		}
		!empty($html) && $html .= '</ul>';
		return $html;
	}
	// Render menu
	public static function render($_Params) {
		if(isset($_Params->menu)) {
			$menu = $_Params->menu;
		} else {
			$menu = Configuration::getDefault('menu','mainmenu');
		}
		$html = '';
		$_Menu = Menu::get($menu,"`@attribute`,`@option`,accesslevel,title",1);
		if($_Menu) {
			$html .= self::showOptions($_Menu);
		}
		return $html;				
	}
}
?>