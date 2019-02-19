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
	
	// Archive the item
	public static function archive($id) {
		$list = [':id'=>$id,':status'=>STATUS_ARCHIVED,'modified'=>'NOW()','editor'=>Session::getUser()];
		self::getDB()->update(strtolower(self::getClass()))->data($list);
		if(empty($id)) {
			self::getDB()->where("`#`<0");			// Safety net if no valid $id is provided
		} elseif(is_numeric($id)) {
			self::getDB()->where("`#`=:id");
		} else {
			self::getDB()->where("`name`=:id");
		}
		return self::getDB()->execute($list);
	}
	
	// Determine if a record exists; used to verify uniqueness
	public static function exists($id,$filter = "1") {
		return self::get($id,"`#`",$filter);			// Only return an object with the id, otherwise return nothing
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
	
	// Parse associative array to determine which fields should be updated/inserted
	public static function parseData($data) {
		$attribute = (object)[];
		foreach($data as $property=>$value) {
			if(substr($property,0,1) == '@') {
				// This is an attribute; add to list of attributes
				$key = substr($property,1);
				$attribute->$key = $value;
				unset($data[$property]);
			} elseif(substr($property,0,1) == '+') {
				// This is a counter; increment
				$data[substr($property,1)] = substr($property,1).'+'.$value;
				unset($data[$property]);
			} elseif(substr($property,0,1) == ':') {
				// Value has changed; parse
				if(substr($property,1,7) == 'filter-') {
					// This is a filter selection; remove
					unset($data[$property]);
				} elseif(substr($property,1) == 'password') {
					// This is a password; encrypt
					$data[$property] = crypt($value,'$2a$11$'.uniqid('',true).'$');
				} elseif(substr($property,1,1) == '$') {
					// This is a file; save as binary
					$data[':mimetype'] = $value['type'];
					$data[substr($property,2)] = $value['tmp_name'];
					unset($data[$property]);
				} else {
					// No change
				}
			} else {
				// Value has not changed; remove
				unset($data[$property]);
			}
		}
		if(!empty($attribute)) {
			$data['@attribute'] = json_encode($attribute);
		}
		return $data;
	}
	
	// Save the object with provided data
	//   If ':id' is provided, update, otherwise insert
	public static function save($data) {
		$list = self::parseData($data);
		// If being published add publisher info
		if(isset($list[':status']) && $list[':status'] == STATUS_PUBLISHED) {
			$list['published'] = 'NOW()';
			$list['publisher'] = Session::getUser();
		}
		if(isset($list[':id'])) {
			// Add editor info and send to database
			$list['modified'] = 'NOW()';
			$list['editor'] = Session::getUser();
			self::getDB()->update(strtolower(self::getClass()))->data($list)->where('`#`=:id');
		} else {
			// Add author info and send to database
			$list['created'] = 'NOW()';
			$list['author'] = Session::getUser();
			self::getDB()->insert(strtolower(self::getClass()))->data($list);
		}
		return self::getDB()->execute($list);
	}
	
	// Rather than deleting, an item can be trashed
	public static function trash($id) {
		$list = [':id'=>$id,':status'=>STATUS_TRASHED,'modified'=>'NOW()','editor'=>Session::getUser()];
		self::getDB()->update(strtolower(self::getClass()))->data($list);
		if(empty($id)) {
			self::getDB()->where("`#`<0");			// Safety net if no valid $id is provided
		} elseif(is_numeric($id)) {
			self::getDB()->where("`#`=:id");
		} else {
			self::getDB()->where("`name`=:id");
		}
		return self::getDB()->execute($list);
	}
}
?>