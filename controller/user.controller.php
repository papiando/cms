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
		// Call new router to login article
		$_Router = new Router('/article/login');
		$controller = __CUBO__.'\\'.$_Router->getController().'controller';
		$method = $_Router->getMethod();
		try {
			if(class_exists($controller)) {
				if(method_exists($controller,$method)) {
					// Call the method and show the output
					$_Controller = new $controller($_Router);
					$output = $_Controller->$method();
					return $output;
				} else {
					// Method does not exist for this controller
					$controller = $_Router->getController();
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Controller '{$controller}' does not have the method '{$method}' defined"]);
				}
			} else {
				// Controller not found
				$controller = $_Router->getController();
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Controller '{$controller}' does not exist"]);
			}
		} catch(Error $_Error) {
			$_Error->showMessage();
		}
		return false;
	}
}
?>