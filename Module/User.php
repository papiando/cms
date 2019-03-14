<?php
/**
 * @application    Cubo CMS
 * @type           Module
 * @class          User
 * @version        2.1.0
 * @date           2019-03-11
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Module;
use Cubo\Framework\Addon;
use Cubo\Framework\Application;
use Cubo\Framework\Configuration;
use Cubo\Framework\Session;
use Cubo\Model\Image;

class User extends Addon {
	// Render user avatar
	public static function render($_Params) {
		// Check if show-user-module is turned on
		if(Configuration::getParameter('show-user-module',SETTING_YES))
			// Save this URI in session
			Session::set('lastVisited',$_SERVER['REQUEST_URI']);
		else
			return false;
		// Now render the rest
		$path = Application::getRouter()->getRoute();
		if(Session::isGuest()) {
			$html = '<a class="nav-link p-0 text-nowrap d-flex align-items-center" href="'.$path.'user/login"><span class="circle"><i class="fa fa-user-lock fa-fw fa-lg"></i></span><span class="d-none d-md-inline pl-2">Login</span></a>';
		} else {
			if(Session::get('User')->avatar) {
				$Image = Image::get(Session::get('User')->avatar,"`name`,`title`");
				$image_html = '<img src="/image/'.$Image->name.'?avatar" alt="'.Session::get('User')->title.'" />';
			} else {
				$image_html = '<i class="fa fa-user fa-fw fa-lg"></i>';
			}
			$html = '<a class="nav-link p-0 text-nowrap d-flex align-items-center" href="'.$path.'user/'.Session::get('User')->name.'"><span class="circle">'.$image_html.'</span><span class="d-none d-md-inline pl-2">'.Session::get('User')->title.'</span></a>';
		}
		return $html;
	}
}
?>