<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Plugin extends Model {
	// Retrieve set of records from the model
	public static function getAll($columns = "`#`,`accesslevel`,`name`,`status`",$filter = "`status`=".STATUS_PUBLISHED,$order = "`#`") {
		return parent::getAll($columns,$filter,$order);
	}
}
?>