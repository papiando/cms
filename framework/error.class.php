<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Error extends \Exception {
	protected $_Error;
	
	// Constructor reads error and saves info as object
	public function __construct($error) {
		if(is_array($error)) {
			$this->_error = (object)$error;
			$this->_error->description = $this->_error->description ?? '<p>Please <a href="/contact/admin">contact</a> your site administrator.</p>';
		} else {
			$this->_error = (object)array('source'=>'Unknown','severity'=>3,'message'=>$error,'description'=>'<p>Please <a href="/contact/admin">contact</a> your site administrator.</p>');
		}
		parent::__construct($this->_error->message ?? 'Unknown error',$this->_error->code ?? 0);
	}
	
	// Custom string representation of error
	public function __toString() {
		return $this->_error->message;
	}
	
	// Display error template
	public function showMessage() {
		$_error = $this->_error;
		if(defined('DEBUG')) {
			$this->_error->description .= "<hr /><p>Error was thrown from:</p><table>";
			if(isset($this->_error->class)) $this->_error->description .= "<tr><td>Class:</td><td>".($this->_error->class)."</td></tr>";
			if(isset($this->_error->method)) $this->_error->description .= "<tr><td>Method:</td><td>".($this->_error->method)."</td></tr>";
			if(isset($this->_error->function)) $this->_error->description .= "<tr><td>Function:</td><td>".($this->_error->function)."</td></tr>";
			if(isset($this->_error->file)) $this->_error->description .= "<tr><td>Script:</td><td>".($this->_error->file)."</td></tr>";
			if(isset($this->_error->line)) $this->_error->description .= "<tr><td>Line:</td><td>".($this->_error->line)."</td></tr>";
			$this->_error->description .= "</table>";
		}
		empty($this->_error->response) || http_response_code($this->_error->response);
		include('error.php');
		die();
	}
}
?>