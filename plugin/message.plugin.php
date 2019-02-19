<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class MessagePlugin extends Addon {
	// Retrieve messages
	public static function getMessages() {
		$html = '';
		$_Messages = Session::getMessages();
		foreach($_Messages as $_Message) {
			is_array($_Message) && $_Message = (object)$_Message;
			$html .= '<div class="alert alert-'.$_Message->alert.' alert-dismissible fade show" role="alert">';
			$html .= '<strong><i class="fa fa-'.$_Message->icon.'"></i></strong> '.$_Message->message;
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>';
			$html .= '</div>';
		}
		return $html;
	}
	
	// Replaces message tag with messages
	public static function render($html) {
		if($html) {
			return preg_replace("/<cubo:message\s*\/>/i",self::getMessages(),$html);
		} else {
			return false;
		}
	}
}
?>