<?php
/**
 * @application    Cubo CMS
 * @type           Model
 * @class          Language
 * @version        2.0.4
 * @date           2019-03-03
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

class Language extends Model {
	// Retrieve a single record from the model
	public static function getLanguage($id) {
		$columns = "`#`,`name`,`accesslevel`,`alpha2`,`alpha3`,`status`,`title`";
		self::getDB()->select($columns)->from(strtolower(self::getClass()));
		if(empty($id)) {
			return null;								// Safety net if no valid $id is provided
		} elseif(is_numeric($id)) {
			self::getDB()->where("`#`=:id");			// A number was provided
		} elseif(strlen($id) == 2) {
			self::getDB()->where("`alpha2`=:id");		// An two letter alpha code was provided
		} elseif(strlen($id) == 3) {
			self::getDB()->where("`alpha3`=:id");		// An three letter alpha code was provided
		} else {
			self::getDB()->where("`name`=:id");
		}
		$result = self::getDB()->loadObject([':id'=>$id]);
		return (is_object($result) ? $result : null);	// Only return the object, otherwise return nothing
	}
}
?>