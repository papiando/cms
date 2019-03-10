<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          View
 * @version        2.1.0
 * @date           2019-03-10
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Framework;
use Cubo\Model\Image as Image;
use Cubo\Model\Plugin as Plugin;
use Cubo\Model\Template as Template;

class View {
	protected $Attribute;
	
	// Get attribute
	public function getAttribute($attribute) {
		return (isset($this->Attribute[$attribute]) && $this->Attribute[$attribute] != SETTING_GLOBAL ? $this->Attribute[$attribute] : Configuration::getAttribute($attribute) ?? null);
	}
	
	public function all(&$Data) {
		// Store the article attributes
		if(empty($this->Attribute))
			!empty($Data->{'@attribute'}) && $this->Attribute = json_decode($Data->{'@attribute'},true);
		// Retrieve the template; we need the template attributes as they are global settings
		$Template = Template::get($Data->template ?? Configuration::getDefault('template','default'),"`name`,`@attribute`");
		if($Template) {
			// Save template name as parameter
			Configuration::setParameter('template',$Template->name);
			// Save template attributes as global settings
			!empty($Template->{'@attribute'}) && Configuration::set('Attribute',json_decode($Template->{'@attribute'},true));
		}
		// Get the body of the article
		$html = $this->showList($Data);
		// Render plugins and return output
		return $this->renderPlugins($html);
	}
	
	public function default(&$Data) {
		return $this->view($Data);
	}
	
	// Render the plugins; these render things such as the template and modules
	public function renderPlugins($html) {
		// Render plugins
		$Plugins = Plugin::getAll();
		foreach($Plugins as &$Plugin) {
			$plugin = __CUBO__.'\\Plugin\\'.ucfirst($Plugin->name);
			if(class_exists($plugin))
				$html = $plugin::render($html);
		}
		return $html;
	}
	
	public function view(&$Data) {
		// Store the article attributes
		!empty($Data->{'@attribute'}) && $this->Attribute = json_decode($Data->{'@attribute'},true);
		// Retrieve the template; we need the template attributes as they are global settings
		$Template = Template::get($Data->template ?? Configuration::getDefault('template','default'),"`name`,`@attribute`");
		if($Template) {
			// Save template name as parameter
			Configuration::setParameter('template',$Template->name);
			// Save template attributes as global settings
			!empty($Template->{'@attribute'}) && Configuration::set('Attribute',json_decode($Template->{'@attribute'},true));
		}
		// Get the body of the article
		$html = $this->showItem($Data);
		// Render plugins and return output
		return $this->renderPlugins($html);
	}
	
	// Shared function to show item text in uniform way
	public function showBody(&$Data) {
		return $Data->body ?? '';
	}
	
	// Shared function to show item image in uniform way
	public function showImage(&$Data) {
		$html = '';
		if($Image = Image::get($Data->image,'name,title')) {
			$html = '<img class="article-image" src="'.__BASE__.'/image/'.urlencode($Image->name).'" alt="'.htmlspecialchars($Image->title,ENT_QUOTES|ENT_HTML5).'" />';
		}
		return $html;
	}
	
	// Shared function to show an item
	public function showItem(&$Data) {
		$html = '<div class="article">';
		$html = '<h1 class="article-title">'.$this->showTitle($Data).'</h1>';
		$html .= '<div class="article-body">'.$this->showBody($Data).'</div>';
		return $html;
	}
	
	// Shared function to show a list of items
	public function showList(&$Data) {
		$html = '<ul class="item-list">';
		foreach($this->Data as $item)
			$html .= '<li class="list-item">'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		return $html;
	}
	
	// Shared function to show item heading in uniform way
	public function showTitle(&$Data) {
		return '<h1 class="article-title">'.htmlspecialchars($Data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
}
?>