<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          Article
 * @version        2.1.0
 * @date           2019-03-11
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Controller;
use Cubo\Framework\Controller;

class Article extends Controller {
	protected $columns = "*";
	
	public function view() {
		if($result = parent::view()) {
			$this->Model::visit($this->getRouter()->getName());
		}
		return $result;
	}
}
?>