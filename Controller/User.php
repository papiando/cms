<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          User
 * @version        2.1.0
 * @date           2019-03-11
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Controller;
use Cubo\Framework\Configuration;
use Cubo\Framework\Controller;
use Cubo\Framework\Error;
use Cubo\Framework\Router;
use Cubo\Framework\Session;
use Cubo\Model\User as UserModel;

class User extends Controller {
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
			$User = UserModel::getLogin(strtolower($_POST['user']));
			try {
				if($User) {
					if($User->blocked) {
						// User is blocked
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' is blocked (denied access)"]);
					} elseif($User->status != STATUS_PUBLISHED) {
						// User is not published
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' is not published (disabled)"]);
					} elseif(!$User->verified) {
						// User is not verified
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' is not verified yet"]);
					} elseif(!hash_equals($User->password,crypt($_POST['password'],$User->password))) {
						// Password is incorrect
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' supplied a wrong password"]);
					} else {
						// User authenticated, now first remove information
						unset($User->password);
						// Save user data in session
						Session::set('User',$User);
						Session::setMessage(array('alert'=>'success','icon'=>'check','message'=>"Welcome {$User->title}"));
						if(Session::exists('loginRedirect')) {
							$this->Router::redirect(Session::get('loginRedirect') ?? $this->Router->getRoute());
						} else {
							$this->Router::redirect(Session::get('lastVisited') ?? $this->Router->getRoute());
						}
					}
				} else {
					// User does not exist
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"User '{$_POST['user']}' does not exist"]);
				}
			} catch(Error $Error) {
				$Error->showMessage();
			}
		} else {
			// Call new router to login article
			$Router = new Router('/article/login');
			$controller = __CUBO__.'\\Controller\\'.$Router->getController();
			$method = $Router->getMethod();
			try {
				if(class_exists($controller)) {
					if(method_exists($controller,$method)) {
						// Call the method and show the output
						$Controller = new $controller($Router);
						$output = $Controller->$method();
						return $output;
					} else {
						// Method does not exist for this controller
						$controller = $Router->getController();
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Controller '{$controller}' does not have the method '{$method}' defined"]);
					}
				} else {
					// Controller not found
					$controller = $Router->getController();
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Controller '{$controller}' does not exist"]);
				}
			} catch(Error $Error) {
				$Error->showMessage();
			}
		}
		return false;
	}
	
	// Method: logout
	public function logout() {
		Session::setMessage(array('alert'=>'info','icon'=>'exclamation','message'=>"See you later, {Session::get('User')->title}"));
		Session::delete('User');
		Router::redirect(Session::get('lastVisited') ?? '/');
	}
}
?>