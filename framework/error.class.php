<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

define('ERROR_FATAL',1);
define('ERROR_CRITICAL',2);
define('ERROR_SEVERE',3);
define('ERROR_WARNING',4);

class Error extends \Exception {
	protected $_Error;
	
	// Constructor reads error and saves info as object
	public function __construct($error) {
		if(is_array($error)) {
			$this->_Error = (object)$error;
			$this->_Error->description = $this->_error->description ?? '<p>Please <a href="/contact/admin">contact</a> your site administrator.</p>';
		} else {
			$this->_Error = (object)['file'=>__FILE__,'severity'=>ERROR_SEVERE,'message'=>$error,'description'=>'<p>Please <a href="/contact/admin">contact</a> your site administrator.</p>'];
		}
		parent::__construct($this->_Error->message ?? 'Unknown error',$this->_Error->code ?? 0);
	}
	
	// Custom string representation of error
	public function __toString() {
		return $this->_Error->message;
	}
	
	// Display error template
	public function showMessage() {
		if(defined('DEBUG')) {
			$this->_Error->description .= "<hr /><p>Error was thrown from:</p><table>";
			if(isset($this->_Error->class)) $this->_Error->description .= "<tr><td>Class:</td><td>".($this->_Error->class)."</td></tr>";
			if(isset($this->_Error->method)) $this->_Error->description .= "<tr><td>Method:</td><td>".($this->_Error->method)."</td></tr>";
			if(isset($this->_Error->function)) $this->_Error->description .= "<tr><td>Function:</td><td>".($this->_Error->function)."</td></tr>";
			if(isset($this->_Error->file)) $this->_Error->description .= "<tr><td>Script:</td><td>".($this->_Error->file)."</td></tr>";
			if(isset($this->_Error->line)) $this->_Error->description .= "<tr><td>Line:</td><td>".($this->_Error->line)."</td></tr>";
			$this->_Error->description .= "</table>";
		}
		empty($this->_Error->response) || http_response_code($this->_Error->response);
		include(__ROOT__.DS.'error.php');
		die();
	}
}
?>