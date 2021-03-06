<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class LoginModule extends Addon {
	// Render login form
	public static function render($_Params) {
		$html = '<form class="form-login" action="" method="post">';
		$html .= '<div class="form-group"><label for="user">Login name</label><input type="text" name="user" id="user" value="" class="form-control" placeholder="Login name" required autofocus autocomplete="off" /></div>';
		$html .= '<div class="form-group"><label for="password">Password</label><input type="password" name="password" id="password" value="" class="form-control" placeholder="Password" required /></div>';
		$html .= '<div class="form-group"><button class="btn btn-primary" type="submit">Login</button></div>';
		$html .= '</form>';
		return $html;
	}
}
?>