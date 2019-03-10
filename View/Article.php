<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @class          Article
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\View;
use Cubo\Framework\Application as Application;
use Cubo\Framework\Configuration as Configuration;
use Cubo\Framework\View as View;
use Cubo\Model\Contact as Contact;
use Cubo\Model\Image as Image;
use Cubo\Model\User as User;

class Article extends View {
	// Show the item text
	public function showBody(&$Data) {
		$html = '<span class="article-intro">'.($Data->intro ?? '').'</span>';
		$html .= ' '.$Data->body ?? '';
		return trim($html);
	}
	
	// Show the item image
	public function showImage(&$Data) {
		$html = '';
		if($this->getAttribute('show_image') && $Data->image && $Image = Image::get($Data->image,'name,title')) {
			$html = '<figure class="article-image img-container" itemProp="image" itemscope itemtype="https://schema.org/ImageObject"><img class="img-fluid" src="'.__BASE__.'/image/'.urlencode($Image->name).'" alt="'.htmlspecialchars($Image->title,ENT_QUOTES|ENT_HTML5).'" /><meta itemProp="url" content="'.__BASE__.'/image/'.urlencode($Image->name).'" /></figure>';
		}
		return $html;
	}
	
	// show the item info
	public function showInfo(&$Data) {
		$html = '<div class="article-info">';
		$html .= $this->showUser($Data,'author');
		$html .= $this->showUser($Data,'editor');
		$html .= $this->showUser($Data,'publisher');
		$html .= '</div>';
		return $html;
	}
	
	// Show an item
	public function showItem(&$Data) {
		empty($Data->title) || Configuration::setParameter('title',$Data->title);
		$html = '<article class="article" itemScope itemType="https://schema.org/Article">';
		if($this->getAttribute('position-info') == SETTING_ABOVECONTENT) $html .= $this->showInfo($Data);
		if($this->getAttribute('position-image') == SETTING_ABOVETITLE) $html .= $this->showImage($Data);
		if($this->getAttribute('position-info') == SETTING_ABOVETITLE) $html .= $this->showInfo($Data);
		if($this->getAttribute('show-title') == SETTING_SHOW) $html .= $this->showTitle($Data);
		if($this->getAttribute('position-image') == SETTING_BELOWTITLE) $html .= $this->showImage($Data);
		if($this->getAttribute('position-info') == SETTING_BELOWTITLE) $html .= $this->showInfo($Data);
		$html .= '<div itemProp="articleBody">'.$this->showBody($Data).'</div>';
		if($this->getAttribute('position-info') == SETTING_BELOWCONTENT) $html .= $this->showInfo($Data);
		$html .= '</article>';
		return $html;
	}
	
	// Show a list of items
	public function showList(&$Data) {
		$html = '<ul class="item-list" itemScope itemType="ItemList">';
		foreach($Data as $item)
			$html .= '<li class="list-item" itemProp="itemListElement" itemScope itemType="ListItem">'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		// Change title; take from Application; should still convert to plural
		Configuration::setParameter('title',ucfirst(Application::getRouter()->getController()));
		return $html;
	}
	
	// Show the item title
	public function showTitle(&$Data) {
		return '<h1 class="article-title" itemProp="name headline">'.htmlspecialchars($Data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
	
	// Show the user data
	public function showUser(&$Data,$person) {
		$html = '';
		if(($User = User::get($Data->$person,'contact,name,title')) && $this->getAttribute('show-'.$person)) {
			$html = '<span class="text-nowrap" itemProp="'.$person.'" itemScope itemType="https://schema.org/Person"><i class="fa fa-user"></i> ';
			if(!empty($User->contact) && $Contact = Contact::get($User->contact,'name')) {
				$html .= '<a class="info-link" itemProp="name" href="/contact/'.urlencode($Contact->name).'">'.htmlspecialchars($User->title,ENT_QUOTES|ENT_HTML5).'</a>';
			} else {
				$html .= '<span itemProp="name">'.htmlspecialchars($User->title,ENT_QUOTES|ENT_HTML5).'</span>';
			}
			$html .= '</span> ';
		} elseif($User) {
			$html .= '<meta itemProp="'.$person.'" content="'.htmlspecialchars($User->title,ENT_QUOTES|ENT_HTML5).'" /> ';
		}
		return $html;
	}
}
?>