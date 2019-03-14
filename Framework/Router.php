<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Router
 * @version        2.1.0
 * @date           2019-03-11
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;

final class Router {
	private $controller;
	private $format;
	private $method;
	private $name;
	private $Route;
	
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
	
	// Get parsed language
	public function getLanguage() {
		return $this->language;
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
		return empty($this->Route->path) ? '/' : '/'.trim($this->Route->path,'/').'/';
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
		$routes = (array)Configuration::get('route',(object)[''=>(object)[]]);
		// Predefine default route, controller, and method
		$this->Route = $routes[''];
		$this->controller = Configuration::getDefault('controller','article');
		$this->format = Configuration::getDefault('format',$_GET['format'] ?? 'html');
		$this->language = Configuration::getDefault('language',$_GET['lang'] ?? 'undefined');
		$this->method = Configuration::getDefault('method','default');
		// Parse the URL part of URI
		if(count($path_parts)) {
			$part = strtolower(current($path_parts));
			// Get route if given
			if(in_array($part,array_keys($routes))) {
				$this->Route = $routes[$part];
				defined('__ROUTE__') || define('__ROUTE__',trim($this->getRoute(),'/'));
				$this->controller = $this->Route->controller ?? $this->Route->{'default-controller'} ?? $this->controller;
				$this->format = $this->Route->format ?? $this->Route->{'default-format'} ?? $this->format;
				$this->language = $this->Route->language ?? $this->Route->{'default-language'} ?? $this->language;
				$this->method = $this->Route->method ?? $this->Route->{'default-method'} ?? $this->method;
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Get controller if given
			if($part) {
				if(class_exists(__CUBO__.'\\Controller\\'.$part))
					$this->controller = $part;
				else
					$this->controller = $part;		 // Controller does not exist, give back anyhow
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Get method if given
			if($part) {
				if(method_exists(__CUBO__.'\\Controller\\'.$this->controller,$part))
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
		$this->name = empty($this->name) ? Configuration::getDefault($this->controller,'default') : $this->name;
	}
	
	// Redirect function; by default supplied a 301 Moved Permanently response
	public static function redirect($location,$response = 301) {
		Session::set('http_response',$response);
		exit(header("Location: {$location}"));
	}
}
?>