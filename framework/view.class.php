<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class View {
	public function __construct() {
	}
	
	public function default($_Data) {
		return $this->html($_Data);
	}
	
	public function html($_Data) {
		if(is_array($_Data)) {
			return $this->showList($_Data);
		} else {
			return $this->showItem($_Data);
		}
	}
	
	public function showItem($_Data) {
		$html = '<h1>'.$_Data->title.'</h1>';
		$html .= '<div>'.$_Data->html.'</div>';
		return $html;
	}
	
	public function showList($_Data) {
		$html = '<ul>';
		foreach($_Data as $item)
			$html .= '<li>'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		return $html;
	}
}
?>