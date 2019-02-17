<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Session {
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
		$messages = $_SESSION['_Message'] ?? [];
		unset($_SESSION['_Message']);
		return $messages;
	}
	
	// Returns the user id of the currently logged in user, or NOBODY if not logged in
	public static function getUser() {
		return (isset($_SESSION['_User']) ? $_SESSION['_User']->id : USER_NOBODY);
	}
	
	// Returns the role id of the currently logged in user, or GUEST if not logged in
	public static function getRole() {
		return (isset($_SESSION['_User']) ? $_SESSION['_User']->role : ROLE_GUEST);
	}
	
	// Returns true if there are messages waiting
	public static function hasMessage() {
		return isset($_SESSION['_Message']) && count($_SESSION['messages']);
	}
	
	// Return session ID
	public static function id() {
		return self::$id;
	}
	
	// Returns true if user is logged in as content manager
	public static function isAdmin() {
		return self::exists('_User') && in_array(self::get('_User')->role,[ROLE_AUTHOR,ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR]);
	}
	
	// Returns true if the item is accessible for the current user
	public static function isAccessible($includeNone = false,$excludeSelf = false) {
		return "`status`=".STATUS_PUBLISHED.($excludeSelf ? " AND `id`<>".$excludeSelf : "").($includeNone ? " OR `accesslevel`=".ACCESS_NONE : " AND `accesslevel`<>".ACCESS_NONE);
	}
	
	// Returns true if user is not logged in
	public static function isGuest() {
		return !self::exists('_User');
	}
	
	// Returns true if user is logged in
	public static function isRegistered() {
		return self::exists('_User');
	}
	
	// Store session property
	public static function set($property,$value) {
		return $_SESSION[$property] = $value;
	}
	
	// Set a message
	public static function setMessage($message) {
		if(!isset($_SESSION['_Message'])) $_SESSION['_Message'] = [];
		$_SESSION['_Message'][] = $message;
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