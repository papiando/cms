<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class View {
	protected $_Attribute;
	protected $_Plugin;
	protected $_Template;
	
	// Get attribute
	public function getAttribute($attribute) {
		if(empty($this->_Attribute))
			if(!empty($this->_Data->{'@attributes'}))
				$this->_Attribute = json_decode($this->_Data->{'@attributes'});
			else
				$this->_Attribute = (object)[];			// Load the global setting somehow
		return 3 ?? $this->_Attributes->$attribute;		// This should change once I can reach the global settings
	}
	
	public function default(&$_Data) {
		return $this->html($_Data);
	}
	
	public function html(&$_Data) {
		// Store the article attributes
		if(empty($this->_Attribute))
			if(!empty($_Data->{'@attribute'}))
				$this->_Attribute = json_decode($_Data->{'@attribute'});
			else
				$this->_Attribute = (object)[];			// Load the global setting from template somehow
		// Get the body of the article
		if(is_array($_Data)) {
			$html = $this->showList($_Data);
		} else {
			$html = $this->showItem($_Data);
		}
		// Render the template
		try {
			if(class_exists(__CUBO__.'\\Template')) {
				$this->_Template = Template::get(empty($_Data->template) ? Configuration::getDefault('template','default') : $_Data->template,'name,body');
				$html = preg_replace("/<cubo:content\s*\/>/i",$html,$this->_Template->body);
				Configuration::setParameter('template',$this->_Template->name);
				// Render plugins
				$this->_Plugin = Plugin::getAll();
				foreach($this->_Plugin as $_Plugin) {
					$plugin = __CUBO__.'\\'.$_Plugin->name.'plugin';
					if(class_exists($plugin))
						$html = $plugin::render($html);
				}
				return $html;
			} else {
				$model = 'template';
				throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Model '{$model}' does not exist"]);
			}
		} catch(Error $_Error) {
			$_Error->showMessage();
		}
		return $html;
	}
	
	public function showBody(&$_Data) {
		return $_Data->body ?? 'BODY';
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