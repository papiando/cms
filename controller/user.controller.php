<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserController extends Controller {
	protected $columns = "*";
	
	// Method: login
	public function login() {
		// First change response code if redirected
		if(!empty(Session::get('http_response'))) {
			http_response_code(Session::get('http_response'));
			Session::delete('http_response');
		}
		$model = __CUBO__.'\\'.Application::getRouter()->getController();
		$view = __CUBO__.'\\'.Application::getRouter()->getController().'view';
		$method = Application::getRouter()->getMethod();
		if(class_exists($view)) {
			if(method_exists($view,$method)) {
				// Call method and return output
				self::$_View = new $view;
				return self::$_View->$method();
			} else {
				// Method does not exist for this view
				$view = Application::getRouter()->getController();
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"View '{$view}' does not have the method '{$method}' defined"]);
			}
		} else {
			// View not found
			$view = Application::getRouter()->getController();
			throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"View '{$view}' does not exist"]);
		}
		return false;
	}
}
?>