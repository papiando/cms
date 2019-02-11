<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class View {
	protected $_Attribute;
	protected $_Data;
	
	public function __construct($_Data) {
		$this->_Data = $_Data;
	}
	
	// Get attribute
	public function getAttribute($attribute) {
		if(empty($this->_Attribute))
			if(!empty($this->_Data->{'@attributes'}))
				$this->_Attribute = json_decode($this->_Data->{'@attributes'});
			else
				$this->_Attribute = (object)[];			// Load the global setting somehow
		return 3 ?? $this->_Attributes->$attribute;		// This should change once I can reach the global settings
	}
	
	public function default() {
		return $this->html();
	}
	
	public function html() {
		if(is_array($this->_Data)) {
			return $this->showList($this->_Data);
		} else {
			return $this->showItem($this->_Data);
		}
	}
	
	public function showBody(&$_Data) {
		return $_Data->html ?? 'BODY';
	}
	
	public function showImage(&$_Data) {
		return $_Data->image ?? 'IMAGE';
	}
	
	public function showInfo(&$_Data) {
		return 'INFO';
	}
	
	public function showItem(&$_Data) {
		$html = '<h1>'.$this->_Data->title.'</h1>';
		$html .= '<div>'.$this->_Data->html.'</div>';
		return $html;
	}
	
	public function showList(&$_Data) {
		$html = '<ul>';
		foreach($this->_Data as $item)
			$html .= '<li>'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		return $html;
	}
	
	public function showTitle(&$_Data) {
		return '<h1>'.htmlspecialchars($_Data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
}
?>