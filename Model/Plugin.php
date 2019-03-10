<?php
/**
 * @application    Cubo CMS
 * @type           Model
 * @class          Plugin
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Model;
use Cubo\Framework\Model as Model;

class Plugin extends Model {
	// Retrieve set of records from the model
	public static function getAll($columns = "`#`,`accesslevel`,`name`,`status`",$filter = "`status`=".STATUS_PUBLISHED,$order = "`#`") {
		return parent::getAll($columns,$filter,$order);
	}
}
?>