<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleController extends Controller {
	protected $columns = "*";
	
	public function view() {
		if($result = parent::view()) {
			$this->_Model::visit($this->getRouter()->getName());
		}
		return $result;
	}
}
?>