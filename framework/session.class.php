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
	
	// Returns the user id of the currently logged in user, or NOBODY if not logged in
	public static function getUser() {
		return (isset($_SESSION['user']) ? $_SESSION['user']->id : USER_NOBODY);
	}
	
	// Returns the role id of the currently logged in user, or GUEST if not logged in
	public static function getRole() {
		return (isset($_SESSION['user']) ? $_SESSION['user']->role : ROLE_GUEST);
	}
	
	// Return session ID
	public static function id() {
		return self::$id;
	}
	
	// Returns true if user is logged in
	public static function isRegistered() {
		return self::exists('user');
	}
	
	// Returns true if user is not logged in
	public static function isGuest() {
		return !self::exists('user');
	}
	
	// Store session property
	public static function set($property,$value) {
		return $_SESSION[$property] = $value;
	}
	
	// Start the session; determine whether it is a new session
	public static function start($session_name,$session_lifetime) {
		// Apply provided session name
		session_name($session_name);
		self::$name = $session_name;
		// See if there is a session cookie
		$newSession = !isset($_COOKIE[$session_name]);
		// Start the session
		session_start();
		$_SESSION['lastaccessed'] = time();
		// Set session cookie life time
		setcookie(session_name(),session_id(),$_SESSION['lastaccessed']+$session_lifetime);
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