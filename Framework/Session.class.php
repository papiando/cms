<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Session
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;

final class Session {
	private static $name;		// Keep session name
	private static $id;			// Keep session id
	private static $lifetime;	// Session life time
	
	// Constructor starts session
	public function __construct($session_name = __CUBO__,$session_lifetime = 3600) {
		self::start($session_name,$session_lifetime);
	}
	
	// Remove session property
	public static function delete($property) {
		if(isset($_SESSION[$property]))
			unset($_SESSION[$property]);
	}
	
	// Return true if the session property exists
	public static function exists($property) {
		return isset($_SESSION[$property]);
	}
	
	// Retrieve session property
	public static function get($property,$default = null) {
		return $_SESSION[$property] ?? $default ?? null;
	}
	
	// Returns all waiting messages
	public static function getMessages() {
		$Messages = $_SESSION['Message'] ?? [];
		unset($_SESSION['Message']);
		return $Messages;
	}
	
	// Returns the user id of the currently logged in user, or NOBODY if not logged in
	public static function getUser() {
		return (isset($_SESSION['User']) ? $_SESSION['User']->{'#'} : USER_NOBODY);
	}
	
	// Returns the role id of the currently logged in user, or GUEST if not logged in
	public static function getRole() {
		return (isset($_SESSION['User']) ? $_SESSION['User']->role : ROLE_GUEST);
	}
	
	// Returns true if there are messages waiting
	public static function hasMessage() {
		return isset($_SESSION['Message']) && count($_SESSION['Message']);
	}
	
	// Return session ID
	public static function id() {
		return self::$id;
	}
	
	// Returns true if the item is accessible for the current user
	public static function isAccessible($includeNone = false,$excludeSelf = false) {
		return "`status`=".STATUS_PUBLISHED.($excludeSelf ? " AND `id`<>".$excludeSelf : "").($includeNone ? " OR `accesslevel`=".ACCESS_NONE : " AND `accesslevel`<>".ACCESS_NONE);
	}
	
	// Returns true if user is logged in as administrator
	public static function isAdministrator() {
		return self::isRegistered() && in_array(self::get('User')->role,[ROLE_ADMINISTRATOR]);
	}
	
	// Returns true if user is logged in as author
	public static function isAuthor() {
		return self::isRegistered() && in_array(self::get('User')->role,[ROLE_AUTHOR,ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR]);
	}
	
	// Returns true if user is logged in as editor
	public static function isEditor() {
		return self::isRegistered() && in_array(self::get('User')->role,[ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR]);
	}
	
	// Returns true if user is not logged in
	public static function isGuest() {
		return !self::exists('User');
	}
	
	// Returns true if user is logged in as manager
	public static function isManager() {
		return self::isRegistered() && in_array(self::get('User')->role,[ROLE_MANAGER,ROLE_ADMINISTRATOR]);
	}
	
	// Returns true if user is logged in as publisher
	public static function isPublisher() {
		return self::isRegistered() && in_array(self::get('User')->role,[ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR]);
	}
	
	// Returns true if user is logged in
	public static function isRegistered() {
		return self::exists('User');
	}
	
	// Store session property
	public static function set($property,$value) {
		return $_SESSION[$property] = $value;
	}
	
	// Set a message
	public static function setMessage($message) {
		if(!isset($_SESSION['Message'])) $_SESSION['Message'] = [];
		$_SESSION['Message'][] = $message;
	}
	
	// Start the session; determine whether it is a new session
	public static function start($session_name,$session_lifetime) {
		// Apply provided session name
		session_name($session_name);
		self::$name = $session_name;
		// See if there is a session cookie
		$newSession = !isset($_COOKIE[$session_name]);
		// Start the session
		session_set_cookie_params($session_lifetime,'/');
		session_start();
		$_SESSION['lastaccessed'] = time();
		// Set session cookie life time
		setcookie(session_name(),session_id(),$_SESSION['lastaccessed']+$session_lifetime,'/');
		self::$lifetime = $session_lifetime;
		$_SESSION['expires'] = time() + $session_lifetime;
		// Retrieve and store session id
		self::$id = session_id();
		// Log entry if a new session was started
		if($newSession) {
			$_SESSION['started'] = $_SESSION['lastaccessed'];
			//new Log(array('name'=>"Session::start",'title'=>"Start session",'description'=>"New session was started with ID '".self::$id."'"));
		}
	}
}
?>