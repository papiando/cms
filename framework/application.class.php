<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

final class Application {
	protected static $_Configuration;
	protected static $_Controller;
	protected static $_Router;
	protected static $_Session;
	protected static $_View;
	
	public function __construct() {
		self::run();
	}
	
	public static function getRouter() {
		return self::$_Router;
	}
	
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
					self::$_Controller = new $controller;
					$_Data = self::$_Controller->$method();
					$view = __CUBO__.'\\'.self::$_Router->getController().'view';
					$format = self::$_Router->getFormat();
					if(class_exists($view)) {
						if(method_exists($view,$format)) {
							// Send retrieved data to view
							self::$_View = new $view;
							$output = self::$_View->$format($_Data);
							echo $output;
							die();
						} else {
							// Method does not exist for this view
							$view = self::$_Router->getController();
							throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"View '{$view}' does not have the method '{$format}' defined"]);
						}
					} else {
						// View not found
						$view = self::$_Router->getController();
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"View '{$view}' does not exist"]);
					}
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