<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Router {
	private $controller;
	private $format;
	private $method;
	private $name;
	private $route;
	
	// Constructor of Router class parses URI
	public function __construct($uri) {
		// Call parser
		$this->parse($uri);
	}
	
	// Get parsed controller
	public function getController() {
		return $this->controller;
	}
	
	// Get parsed format
	public function getFormat() {
		return $this->format;
	}
	
	// Get parsed method
	public function getMethod() {
		return $this->method;
	}
	
	// Get parsed name
	public function getName() {
		return $this->name;
	}
	
	// Get parsed controller
	public function getRoute() {
		return $this->route;
	}
	
	// Parse URI and determine routes
	//   Routes are typically made up like /{route}/{controller}/{method}/{name}
	//   Where both {route} and {method} may be omitted
	//   The parser will determine if a route is valid from the configuration settings
	//   The parser will also determine if a method exists with the specified controller
	//   It will not throw any errors, just report back at best effort
	public function parse($uri) {
		// Remove any trailing slashes
		$uri = urldecode(trim($uri,'/'));
		// Split URI
		$uri_parts = explode('?',$uri);
		$uri_parts[] = '';
		$path_parts = explode('/',$uri_parts[0]);
		// Define accepted routes
		$routes = Configuration::get('_Route',[''=>[]]);
		// Predefine default route, controller, and method
		$this->route = $routes[''];
		$this->controller = Configuration::getDefault('controller','article');
		$this->method = Configuration::getDefault('method','default');
		$this->format = Configuration::getDefault('format','default');
		// Parse the URL part of URI
		if(count($path_parts)) {
			$part = strtolower(current($path_parts));
			// Get route if given
			if(in_array($part,array_keys($routes))) {
				$this->route = $routes[$part];
				define('__ROUTE__',$this->route['path'] ?? null);
				$this->method = $this->route['default-method'] ?? $this->method;
				$this->format = $this->route['default-format'] ?? $this->format;
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Get controller if given
			if($part) {
				if(class_exists(__CUBO__.'\\'.$part.'controller'))
					$this->controller = $part;
				else
					$this->controller = $part; // Controller does not exist, give back anyhow
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Get method if given
			if($part) {
				if(method_exists(__CUBO__.'\\'.$this->controller.'controller',$part))
					$this->method = $part;
				else {
					$this->method = 'default';
					$this->name = $part;
				}
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Remainder is optional name
			$this->name = $this->name ?? $part;
		}
	}
	
	// Redirect function; by default supplied a 301 Moved Permanently response
	public static function redirect($location,$response = 301) {
		Session::set('http_response',$response);
		exit(header("Location: {$location}"));
	}
}
?>