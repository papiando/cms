<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Model {
	protected static $_Database;
	
	// Return name of the class
	public static function getClass() {
		return basename(str_replace('\\','/',get_called_class()));
	}
	
	public static function getDB() {
		// Open to database if not yet opened
		self::$_Database || self::$_Database = new Database(Configuration::get('database'));
		return self::$_Database;
	}
	
	// Retrieve a single record from the model
	public static function get($id,$columns = "*",$filter = "1") {
		self::getDB()->select($columns)->from(strtolower(self::getClass()));
		if(empty($id)) {
			self::getDB()->where("{$filter}");			// Safety net if no valid $id is provided
		} elseif(is_numeric($id)) {
			self::getDB()->where("`#`=:id AND {$filter}");
		} else {
			self::getDB()->where("`name`=:id AND {$filter}");
		}
		$result = self::getDB()->loadObject(array(':id'=>$id));
		return (is_object($result) ? $result : null);	// Only return the object, otherwise return nothing
	}
	
	// Retrieve set of records from the model
	public static function getAll($columns = "*",$filter = "1",$order = "RAND()") {
		self::getDB()->select($columns)->from(strtolower(self::getClass()))->where($filter)->order($order);
		$result = self::getDB()->load();
		return (is_array($result) ? $result : []);		// Only return the array, otherwise return empty array
	}
}
?>