<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

abstract class Controller {
	private static $_Model;
	protected $columns = "*";
	
	// Default access levels
	protected static $_Authors = [ROLE_AUTHOR,ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected static $_Editors = [ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected static $_Publishers = [ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected static $_Managers = [ROLE_MANAGER,ROLE_ADMINISTRATOR];
	protected static $_Administrators = [ROLE_ADMINISTRATOR];
	
	// Returns true if the model includes an access property
	private function containsAccessProperty() {
		return $this->columns == "*" || !(strpos($this->columns,'access') === false);
	}
	
	// Returns true if the model includes a status property
	private function containsStatusProperty() {
		return $this->columns == "*" || !(strpos($this->columns,'status') === false);
	}
	
	// Returns filter for list permission
	public function requireListPermission() {
		$filter = [];
		if($this->containsAccessProperty())
			if(Session::isRegistered())
				$filter[] = '`access` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.')';
			else
				$filter[] = '`access` IN ('.ACCESS_PUBLIC.','.ACCESS_GUEST.')';
		if($this->containsStatusProperty())
			$filter[] = "`status`=".STATUS_PUBLISHED;
		return implode(' AND ',$filter) ?? '1';
	}
	
	// Returns filter for view permission
	private function requireViewPermission() {
		$filter = [];
		if($this->containsAccessProperty())
			if(Session::isRegistered())
				$filter[] = '`access` IN ('.ACCESS_PUBLIC.','.ACCESS_REGISTERED.','.ACCESS_PRIVATE.')';
			else
				$filter[] = '`access` IN ('.ACCESS_PUBLIC.','.ACCESS_GUEST.','.ACCESS_PRIVATE.')';
		if($this->containsStatusProperty())
			$filter[] = "`status`=".STATUS_PUBLISHED;
		return implode(' AND ',$filter) ?? '1';
	}
	
	public function all() {
		$model = __CUBO__.'\\'.Application::getRouter()->getController();
		try {
			if(class_exists($model)) {
				self::$_Model = new $model;
				$result = self::$_Model::getAll($this->columns,$this->requireListPermission());
				return $result;
			} else {
				$model = Application::getRouter()->getController();
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'severity'=>1,'response'=>405,'message'=>"Model '{$model}' does not exist"]);
			}
		} catch(Error $_Error) {
			$_Error->showMessage();
		}
	}
	
	public function default() {
		return $this->view();
	}
	
	public function view() {
		$model = __CUBO__.'\\'.Application::getRouter()->getController();
		try {
			if(class_exists($model)) {
				self::$_Model = new $model;
				$result = self::$_Model::get(Application::getRouter()->getName(),$this->columns,$this->requireViewPermission());
				if($result)
					return $result;
				else {
					// Could not retrieve item, check again to see if it exists
					$result = self::$_Model::get(Application::getRouter()->getName(),$this->columns);
					if($result) {
						if(isset($result->status) && $result->status == STATUS_PUBLISHED) {
							// The item requires the user to login
							$model = ucfirst(Application::getRouter()->getController());
							$name = Application::getRouter()->getName();
							throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"{$model} '{$name}' requires authentication"]);
						} else {
							// The item is not published
							$model = ucfirst(Application::getRouter()->getController());
							$name = Application::getRouter()->getName();
							throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"{$model} '{$name}' is no longer available"]);
						}
					} else {
						// The item really does not exist
						$model = ucfirst(Application::getRouter()->getController());
						$name = Application::getRouter()->getName();
						throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>2,'response'=>405,'message'=>"{$model} '{$name}' does not exist"]);
					}
				}
			} else {
				$model = Application::getRouter()->getController();
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Model '{$model}' does not exist"]);
			}
		} catch(Error $_Error) {
			$_Error->showMessage();
		}
		return $result;
	}
	
	// Special method: create
	public function create() {
	}
	
	// Special method: edit
	public function edit() {
	}
	
	// Special method: trash
	public function trash() {
	}
	
	// Returns true if current user has permitted role to create an item
	public function canCreate() {
		return in_array(Session::getRole(),self::$_authors);
	}
	
	// Returns true if current user does not have permitted role to create an item
	public function cannotCreate() {
		return !$this->canCreate($author);
	}
	
	// Returns true if current user is the author or has permitted role to edit an item
	public function canEdit($author = 0) {
		return in_array(Session::getRole(),self::$_Editors) || Session::getUser() == $author;
	}
	
	// Returns true if current user is not the author and does not have permitted role to edit an item
	public function cannotEdit($author = 0) {
		return !$this->canEdit($author);
	}
	
	// Returns true if current user is the author or has permitted role to publish an item
	public function canManage() {
		return in_array(Session::getRole(),self::$_Managers);
	}
	
	// Returns true if current user is not the author and does not have permitted role to publish an item
	public function cannotManage() {
		return !$this->canManage();
	}
	
	// Returns true if current user is the author or has permitted role to publish an item
	public function canPublish() {
		return in_array(Session::getRole(),self::$_Publishers);
	}
	
	// Returns true if current user is not the author and does not have permitted role to publish an item
	public function cannotPublish() {
		return !$this->canPublish();
	}
	
	// Returns true (for the moment)
	public function canRead() {
		return true;
	}
	
	// Returns false (for the moment)
	public function cannotRead() {
		return !$this->canRead();
	}
}
?>