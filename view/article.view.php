<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleView extends View {
	
	public function showItem(&$_Data) {
		$html = '<article itemScope itemType="https://schema.org/Article">';
		if($this->getAttribute('position_info') == SETTING_ABOVECONTENT) $html .= $this->showInfo($_Data);
		if($this->getAttribute('position_image') == SETTING_ABOVETITLE) $html .= $this->showImage($_Data);
		if($this->getAttribute('position_info') == SETTING_ABOVETITLE) $html .= $this->showInfo($_Data);
		if($this->getAttribute('show_title') == SETTING_SHOW) $html .= $this->showTitle($_Data);
		if($this->getAttribute('position_image') == SETTING_BELOWTITLE) $html .= $this->showImage($_Data);
		if($this->getAttribute('position_info') == SETTING_BELOWTITLE) $html .= $this->showInfo($_Data);
		$html .= '<div itemProp="articleBody">'.$this->showBody($_Data).'</div>';
		if($this->getAttribute('position_info') == SETTING_BELOWCONTENT) $html .= $this->showInfo($_Data);
		$html .= '</article>';
		return $html;
	}
	
	public function showList(&$_Data) {
		$html = '<ul class="item-list" itemScope itemType="ItemList">';
		foreach($this->_Data as $item)
			$html .= '<li class="list-item" itemProp="itemListElement" itemScope itemType="ListItem">'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		return $html;
	}
	
	public function showBody(&$_Data) {
		$html = $_Data->intro ?? '';
		$html .= $_Data->body ?? '';
		return $html;
	}
	
	public function showTitle(&$_Data) {
		return '<h1 itemProp="name headline">'.htmlspecialchars($_Data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
}
?>