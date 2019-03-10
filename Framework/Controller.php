<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Controller
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;

class Controller {
	protected $Model;
	protected $Router;
	protected $View;
	protected $columns = "*";
	
	// Constructor saves router
	public function __construct($Router = null) {
		$this->Router = $Router ?? Application::getRouter();
	}
	
	// Default access levels
	protected $Authors = [ROLE_AUTHOR,ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected $Editors = [ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected $Publishers = [ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected $Managers = [ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected $Administrators = [ROLE_ADMINISTRATOR];
	
	// Returns true if the model includes an access property
	private function containsAccessProperty() {
		return $this->columns == "*" || !(strpos($this->columns,'accesslevel') === false);
	}
	
	// Returns true if the model includes a status property
	private function containsStatusProperty() {
		return $this->columns == "*" || !(strpos($this->columns,'status') === false);
	}
	
	// Returns router
	public function getRouter() {
		return $this->Router;
	}
	
	// Returns filter for list permission
	public function requireListPermission() {
		$filter = [];
		if($this->containsAccessProperty())
			if(Session::isAuthor())
				$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.','.ACCESS_ADMIN.')';
			elseif(Session::isRegistered())
				$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.')';
			else
				$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_GUEST.')';
		if($this->containsStatusProperty())
			$filter[] = "`status`=".STATUS_PUBLISHED;
		return implode(' AND ',$filter) ?? '1';
	}
	
	// Returns filter for view permission
	private function requireViewPermission() {
		$filter = [];
		if($this->containsAccessProperty())
			if(Session::isRegistered())
				$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.','.ACCESS_PRIVATE.')';
			else
				$filter[] = '`accesslevel` IN ('.ACCESS_PUBLIC.','.ACCESS_GUEST.','.ACCESS_PRIVATE.')';
		if($this->containsStatusProperty())
			$filter[] = "`status`=".STATUS_PUBLISHED;
		return implode(' AND ',$filter) ?? '1';
	}
	
	public function all() {
		$model = __CUBO__.'\\Model\\'.ucfirst($this->getRouter()->getController());
		try {
			if(class_exists($model)) {
				$this->Model = new $model;
				$Data = $this->Model::getAll($this->columns,$this->requireListPermission());
				if($Data) {
					return $this->render($Data);
				} else {
					// No items returned, must be empty data set
					$model = ucfirst($this->getRouter()->getController());
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'severity'=>ERROR_WARNING,'response'=>405,'message'=>Text::_('no-data-model',['model'=>$model])]);
				}
			} else {
				$model = ucfirst($this->getRouter()->getController());
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'severity'=>ERROR_CRITICAL,'response'=>405,'message'=>Text::_('unknown-model',['model'=>$model])]);
			}
		} catch(Error $Error) {
			$Error->showMessage();
		}
		return false;
	}
	
	// Default method redirects to view
	public function default() {
		return $this->view();
	}
	
	// Call view with requested method
	protected function render($Data) {
		$view = __CUBO__.'\\View\\'.ucfirst($this->getRouter()->getController());
		$method = $this->getRouter()->getMethod();
		try {
			if(class_exists($view)) {
				if(method_exists($view,$method)) {
					// Send retrieved data to view and return output
					$this->View = new $view;
					return $this->View->$method($Data);
				} else {
					// Method does not exist for this view
					$view = ucfirst($this->getRouter()->getController());
					throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>ERROR_SEVERE,'response'=>405,'message'=>Text::_('unknown-view-method',['view'=>$view,'method'=>$method])]);
				}
			} else {
				// View not found
				$view = ucfirst($this->getRouter()->getController());
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>ERROR_CRITICAL,'response'=>405,'message'=>Text::_('unknown-view',['view'=>$view])]);
			}
		} catch(Error $Error) {
			$Error->showMessage();
		}
		return false;
	}
	
	public function view() {
		$model = __CUBO__.'\\Model\\'.ucfirst($this->getRouter()->getController());
		try {
			if(class_exists($model)) {
				$this->Model = new $model;
				$Data = $this->Model::get($this->getRouter()->getName(),$this->columns,$this->requireViewPermission());
				if($Data) {
					return $this->render($Data);
				} else {
					// Could not retrieve item, check again to see if it exists
					$result = $this->Model::get($this->getRouter()->getName(),$this->columns);
					if($result) {
						// The item is found; determine if it is published
						if(isset($result->status) && $result->status == STATUS_PUBLISHED) {
							// The item is published; visitor does not have access
							if(Session::isGuest()) {
								// No user is logged in; redirect to login page
								$model = ucfirst($this->getRouter()->getController());
								$name = $this->getRouter()->getName();
								Session::setMessage(['alert'=>'info','icon'=>'exclamation','message'=>"{$model} '{$name}' requires user access"]);
								Session::set('loginRedirect',Configuration::getParameter('uri'));
								Router::redirect($this->getRouter()->getRoute().'user/login',403);
							} else {
								// User is logged in, so does not have required permissions
								$model = ucfirst($this->getRouter()->getController());
								$name = $this->getRouter()->getName();
								throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>3,'response'=>405,'message'=>"User does not have access to {$model} '{$name}'"]);
								//Session::setMessage(['alert'=>'error','icon'=>'exclamation','message'=>"This user has no access to {$this->class}"]);
								//Session::set('loginRedirect',Application::getParam('uri'));
								//Router::redirect('/user?noaccess',403);
							}
						} else {
							// The item is not published
							$model = ucfirst($this->getRouter()->getController());
							$name = $this->getRouter()->getName();
							throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"{$model} '{$name}' is no longer available"]);
						}
					} else {
						// The item really does not exist
						$model = ucfirst($this->getRouter()->getController());
						$name = $this->getRouter()->getName();
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"{$model} '{$name}' does not exist"]);
					}
				}
			} else {
				$model = $this->getRouter()->getController();
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Model '{$model}' does not exist"]);
			}
		} catch(Error $Error) {
			$Error->showMessage();
		}
		return false;
	}
}
?>