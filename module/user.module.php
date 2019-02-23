<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserModule extends Addon {
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
			if(Session::get('_User')->avatar) {
				$_Image = Image::get(Session::get('_User')->avatar,"`name`,`title`");
				$image_html = '<img src="/image/'.$_Image->name.'?avatar" alt="'.Session::get('_User')->title.'" />';
			} else {
				$image_html = '<i class="fa fa-user fa-fw fa-lg"></i>';
			}
			$html = '<a class="nav-link p-0 text-nowrap d-flex align-items-center" href="'.$path.'user/'.Session::get('_User')->name.'"><span class="circle">'.$image_html.'</span><span class="d-none d-md-inline pl-2">'.Session::get('_User')->title.'</span></a>';
		}
		return $html;
	}
}
?>