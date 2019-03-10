<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Error
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;

define('ERROR_FATAL',1);
define('ERROR_CRITICAL',2);
define('ERROR_SEVERE',3);
define('ERROR_WARNING',4);

class Error extends \Exception {
	protected $Error;
	
	// Constructor reads error and saves info as object
	public function __construct($error) {
		if(is_array($error)) {
			$this->Error = (object)$error;
			$this->Error->description = $this->Error->description ?? '<p>Please <a href="/contact/admin">contact</a> your site administrator.</p>';
		} else {
			$this->Error = (object)['file'=>__FILE__,'severity'=>ERROR_SEVERE,'message'=>$error,'description'=>'<p>Please <a href="/contact/admin">contact</a> your site administrator.</p>'];
		}
		parent::__construct($this->Error->message ?? 'Unknown error',$this->Error->code ?? $this->Error->severity ?? 0);
	}
	
	// Custom string representation of error
	public function __toString() {
		return $this->Error->message;
	}
	
	// Display error template
	public function showMessage() {
		// For debugging purposes add a nicely formatted table with additional information
		if(defined('DEBUG')) {
			$this->Error->description .= "<hr /><p>Error was thrown from:</p><table>";
			if(isset($this->Error->class)) $this->Error->description .= "<tr><td>Class:</td><td>".($this->Error->class)."</td></tr>";
			if(isset($this->Error->method)) $this->Error->description .= "<tr><td>Method:</td><td>".($this->Error->method)."</td></tr>";
			if(isset($this->Error->function)) $this->Error->description .= "<tr><td>Function:</td><td>".($this->Error->function)."</td></tr>";
			if(isset($this->Error->file)) $this->Error->description .= "<tr><td>Script:</td><td>".($this->Error->file)."</td></tr>";
			if(isset($this->Error->line)) $this->Error->description .= "<tr><td>Line:</td><td>".($this->Error->line)."</td></tr>";
			$this->Error->description .= "</table>";
		}
		// If response code was provided send it to header
		empty($this->Error->response) || http_response_code($this->Error->response);
		// Make class available via short method
		$Error = $this->Error;
		// Show error page
		include(__ROOT__.DS.'error.php');
		die();
	}
}
?>