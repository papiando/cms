<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Application
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;

final class Application {
	protected static $Configuration;
	protected static $Controller;
	protected static $Router;
	protected static $Session;
	
	// Constructor automatically runs the application
	public function __construct() {
		// Automatically run the application
		self::run();
	}
	
	// Returns the controller
	public static function getController() {
		return self::$Controller;
	}
	
	// Returns the router
	public static function getRouter() {
		return self::$Router;
	}
	
	// Initiates and runs the application
	public static function run() {
		// Get configuration
		self::$Configuration = new Configuration;
		// Start session
		self::$Session = new Session;
		// Call router; save URI, URL, and Route as application parameters
		self::$Router = new Router(Configuration::setParameter('uri',$_SERVER['REQUEST_URI']));
		// Set application parameters
		Configuration::setParameter('base-url',__BASE__);
		Configuration::setParameter('brand-logo',Configuration::get('brand-logo','/vendor/cubo-cms/asset/image/cubo-w192.png'));
		Configuration::setParameter('brand-name',Configuration::get('brand-name','<strong>Cubo</strong> <em>CMS</em>'));
		Configuration::setParameter('generator',"Cubo CMS by Papiando");
		Configuration::setParameter('generator-url',"https://cubo-cms.com");
		Configuration::setParameter('language',Configuration::getDefault('language','en'));
		Configuration::setParameter('provider',"Papiando Riba Internet");
		Configuration::setParameter('provider-url',"https://papiando.com");
		Configuration::setParameter('route',self::$Router->getRoute() ?? Configuration::getDefault('route','/'));
		Configuration::setParameter('site-name',Configuration::get('site-name','Cubo CMS'));
		Configuration::setParameter('template',Configuration::getDefault('template','default'));
		Configuration::setParameter('theme',Configuration::getDefault('theme','default'));
		Configuration::setParameter('title',Configuration::get('site-name','Cubo CMS'));
		Configuration::setParameter('url',__BASE__.current(explode('?',$_SERVER['REQUEST_URI'])));
		// Read route, controller, method, and name
		$controller = __CUBO__.'\\Controller\\'.self::$Router->getController();
		$method = self::$Router->getMethod();
		try {
			if(class_exists($controller)) {
				if(method_exists($controller,$method)) {
					// Call the method and show the output
					self::$Controller = new $controller;
					$output = self::$Controller->$method();
					echo $output;
				} else {
					// Method does not exist for this controller
					$controller = self::$Router->getController();
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>ERROR_SEVERE,'response'=>405,'message'=>Text::_('unknown-controller-method',['controller'=>$controller,'method'=>$method])]);
				}
			} else {
				// Controller not found
				$controller = self::$Router->getController();
				$text = Text::_('-unknown-controller',['controller'=>$controller]);
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>ERROR_CRITICAL,'response'=>405,'message'=>Text::_('unknown-controller',['controller'=>$controller])]);
			}
		} catch(Error $Error) {
			$Error->showMessage();
		}
	}
}
?>