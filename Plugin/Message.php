<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          Message
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Plugin;
use Cubo\Framework\Addon as Addon;
use Cubo\Framework\Session as Session;

class Message extends Addon {
	// Retrieve messages
	public static function getMessages() {
		$html = '';
		$Messages = Session::getMessages();
		foreach($Messages as $Message) {
			is_array($Message) && $Message = (object)$Message;
			$html .= '<div class="alert alert-'.$Message->alert.' alert-dismissible fade show" role="alert">';
			$html .= '<strong><i class="fa fa-'.$Message->icon.'"></i></strong> '.$Message->message;
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