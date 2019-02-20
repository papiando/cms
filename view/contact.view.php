<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContactView extends View {
	// Show an item
	public function showItem(&$_Data) {
		empty($_Data->title) || Configuration::setParameter('title',$_Data->title);
		$html = '<article class="article" itemScope itemType="https://schema.org/Article">';
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
	
	// Show a list of items
	public function showList(&$_Data) {
		$html = '<ul class="item-list" itemScope itemType="ItemList">';
		foreach($this->_Data as $item)
			$html .= '<li class="list-item" itemProp="itemListElement" itemScope itemType="ListItem">'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		// Change title; take from Application; should still convert to plural
		Configuration::setParameter('title',ucfirst(Application::getRouter()->getController()));
		return $html;
	}
	
	// Show the item text
	public function showBody(&$_Data) {
		return $_Data->body ?? '';
	}
	
	// Show the item image
	public function showImage(&$_Data) {
		$html = '';
		if($this->getAttribute('show_image') && $_Image = Image::get($_Data->image,'name,title')) {
			$html = '<figure class="contact-image img-container" itemProp="image" itemscope itemtype="https://schema.org/ImageObject"><img class="img-fluid" src="'.__BASE__.'/image/'.urlencode($_Image->name).'" alt="'.htmlspecialchars($_Image->title,ENT_QUOTES|ENT_HTML5).'" /><meta itemProp="url" content="'.__BASE__.'/image/'.urlencode($_Image->name).'" /></figure>';
		}
		return $html;
	}
	
	// show the item info
	public function showInfo(&$_Data) {
		$html = '<div class="contact-info">';
		$html .= $this->showUser($_Data,'author');
		$html .= $this->showUser($_Data,'editor');
		$html .= $this->showUser($_Data,'publisher');
		$html .= '</div>';
		return $html;
	}
	
	// Show the item title
	public function showTitle(&$_Data) {
		return '<h1 class="contact-title" itemProp="name headline">'.htmlspecialchars($_Data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
	
	// Show the user data
	public function showUser(&$_Data,$person) {
		$html = '';
		if(($_User = User::get($_Data->$person,'contact,name,title')) && $this->getAttribute('show_'.$person)) {
			$html = '<span class="text-nowrap" itemProp="'.$person.'" itemScope itemType="https://schema.org/Person"><i class="fa fa-user"></i> ';
			if(!empty($_User->contact) && $_Contact = Contact::get($_User->contact,'name')) {
				$html .= '<a class="info-link" itemProp="name" href="/contact/'.urlencode($_Contact->name).'">'.htmlspecialchars($_User->title,ENT_QUOTES|ENT_HTML5).'</a>';
			} else {
				$html .= '<span itemProp="name">'.htmlspecialchars($_User->title,ENT_QUOTES|ENT_HTML5).'</span>';
			}
			$html .= '</span> ';
		} elseif($_User) {
			$html .= '<meta itemProp="'.$person.'" content="'.htmlspecialchars($_User->title,ENT_QUOTES|ENT_HTML5).'" /> ';
		}
		return $html;
	}
}
?>