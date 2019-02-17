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
		// Make sure the user module is not shown
		Configuration::setParameter('show-user-module',SETTING_NO);
		// Determine if login form is filled in
		if($_POST && isset($_POST['user']) && isset($_POST['password'])) {
			$_User = User::getLogin(strtolower($_POST['user']));
			try {
				if($_User) {
					if($_User->blocked) {
						// User is blocked
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' is blocked (denied access)"]);
					} elseif($_User->status != STATUS_PUBLISHED) {
						// User is not published
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' is not published (disabled)"]);
					} elseif(!$_User->verified) {
						// User is not verified
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' is not verified yet"]);
					} elseif(!hash_equals($_User->password,crypt($_POST['password'],$_User->password))) {
						// Password is incorrect
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' supplied a wrong password"]);
					} else {
						// User authenticated, now first remove information
						unset($_User->password);
						// Save user data in session
						Session::set('_User',$_User);
						Session::setMessage(array('alert'=>'success','icon'=>'check','text'=>"Welcome {$_User->title}"));
						if(Session::exists('loginRedirect')) {
							$this->_Router::redirect(Session::get('loginRedirect') ?? $this->_Router::getRoutePath());
						} else {
							$this->_Router::redirect(Session::get('lastVisited') ?? $this->_Router::getRoutePath());
						}
						show($_User);
					}
				} else {
					// User does not exist
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' does not exist"]);
				}
			} catch(Error $_Error) {
				$_Error->showMessage();
			}
		} else {
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
		}
		return false;
	}
	
	// Method: logout
	public function logout() {
		Session::setMessage(array('alert'=>'info','icon'=>'exclamation','text'=>"See you later, {Session::get('_User')->title}"));
		Session::delete('_User');
		Router::redirect(Session::get('lastVisited') ?? '/');
	}
}
?>