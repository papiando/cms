<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserModule extends Addon {
	// Render user avatar
	public static function render($_Params) {
		$html = '<div class="navbar-user dropdown">';
		if(Session::isGuest()) {
			$html .= '<a class="btn p-1" id="user-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-lock fa-fw fa-lg"></i></a>';
			$html .= '<ul class="dropdown-menu" arialabelledby="user-dropdown"><li class="dropdown-header">Not logged in</li><li class="dropdown-item"><a class="nav-link" href="/user/login">Log in</a></li><li class="dropdown-item"><a class="nav-link" href="/user/register">Register</a></li></div>';
		} else {
			$html .= '<a class="btn p-1" id="user-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw fa-lg"></i></a>';
			$html .= '<ul class="dropdown-menu" arialabelledby="user-dropdown"><li class="dropdown-header">'.Session::get('_User')->title.'</li><li class="dropdown-item"><a class="nav-link" href="/user/me">Profile</a></li><li class="dropdown-item"><a class="nav-link" href="/user/logout">Log out</a></li></div>';
		}
		$html .= '</div>';
		return $html;
	}
}
?>