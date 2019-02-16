<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class User extends Model {
	// Retrieve a single record from the model
	public static function getLogin($id) {
		$columns = "`#`,`name`,`accesslevel`,`avatar`,`blocked`,`contact`,`email`,`lastloggedin`,`logins`,`password`,`phone`,`role`,`status`,`title`,`verified`";
		self::getDB()->select($columns)->from(strtolower(self::getClass()));
		if(empty($id)) {
			return false;								// Safety net if no valid $id is provided
		} elseif(strpos($id,'@') > 0) {
			self::getDB()->where("`email`=:id");		// An email address was provided
		} elseif(is_numeric($id)) {
			return false;								// Safety net if user # is provided
		} else {
			self::getDB()->where("`name`=:id");
		}
		$result = self::getDB()->loadObject(array(':id'=>$id));
		return (is_object($result) ? $result : null);	// Only return the object, otherwise return nothing
	}
}
?>