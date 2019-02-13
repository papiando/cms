<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

final class Application {
	protected static $_Configuration;
	protected static $_Controller;
	protected static $_Router;
	protected static $_Session;
	
	// Constructor automatically runs the application
	public function __construct() {
		self::run();
	}
	
	// Returns the router
	public static function getRouter() {
		return self::$_Router;
	}
	
	// Initiates and runs the application
	public static function run() {
		// Get configuration
		self::$_Configuration = new Configuration;
		// Start session
		self::$_Session = new Session;
		// Call router
		self::$_Router = new Router($_SERVER['REQUEST_URI']);
		// Read route, controller, method, and name
		$controller = __CUBO__.'\\'.self::$_Router->getController().'controller';
		$method = self::$_Router->getMethod();
		try {
			if(class_exists($controller)) {
				if(method_exists($controller,$method)) {
					// Call the method and show the output
					self::$_Controller = new $controller;
					$output = self::$_Controller->$method();
					echo $output;
				} else {
					// Method does not exist for this controller
					$controller = self::$_Router->getController();
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Controller '{$controller}' does not have the method '{$method}' defined"]);
				}
			} else {
				// Controller not found
				$controller = self::$_Router->getController();
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Controller '{$controller}' does not exist"]);
			}
		} catch(Error $_Error) {
			$_Error->showMessage();
		}
	}
}
?>