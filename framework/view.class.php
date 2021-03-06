<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          View
 * @version        2.0.4
 * @date           2019-03-05
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

class View {
	protected $_Attribute;
	
	// Get attribute
	public function getAttribute($attribute) {
		return (isset($this->_Attribute[$attribute]) && $this->_Attribute[$attribute] != SETTING_GLOBAL ? $this->_Attribute[$attribute] : Configuration::getAttribute($attribute) ?? null);
	}
	
	public function all(&$_Data) {
		// Store the article attributes
		if(empty($this->_Attribute))
			!empty($_Data->{'@attribute'}) && $this->_Attribute = json_decode($_Data->{'@attribute'},true);
		// Retrieve the template; we need the template attributes as they are global settings
		$_Template = Template::get($_Data->template ?? Configuration::getDefault('template','default'),"`name`,`@attribute`");
		if($_Template) {
			// Save template name as parameter
			Configuration::setParameter('template',$_Template->name);
			// Save template attributes as global settings
			!empty($_Template->{'@attribute'}) && Configuration::set('_Attribute',json_decode($_Template->{'@attribute'},true));
		}
		// Get the body of the article
		$html = $this->showList($_Data);
		// Render plugins and return output
		return $this->renderPlugins($html);
	}
	
	public function default(&$_Data) {
		return $this->view($_Data);
	}
	
	// Render the plugins; these render things such as the template and modules
	public function renderPlugins($html) {
		// Render plugins
		$_Plugins = Plugin::getAll();
		foreach($_Plugins as &$_Plugin) {
			$plugin = __CUBO__.'\\'.$_Plugin->name.'plugin';
			if(class_exists($plugin))
				$html = $plugin::render($html);
		}
		return $html;
	}
	
	public function view(&$_Data) {
		// Store the article attributes
		!empty($_Data->{'@attribute'}) && $this->_Attribute = json_decode($_Data->{'@attribute'},true);
		// Retrieve the template; we need the template attributes as they are global settings
		$_Template = Template::get($_Data->template ?? Configuration::getDefault('template','default'),"`name`,`@attribute`");
		if($_Template) {
			// Save template name as parameter
			Configuration::setParameter('template',$_Template->name);
			// Save template attributes as global settings
			!empty($_Template->{'@attribute'}) && Configuration::set('_Attribute',json_decode($_Template->{'@attribute'},true));
		}
		// Get the body of the article
		$html = $this->showItem($_Data);
		// Render plugins and return output
		return $this->renderPlugins($html);
	}
	
	// Shared function to show item text in uniform way
	public function showBody(&$_Data) {
		return $_Data->body ?? '';
	}
	
	// Shared function to show item image in uniform way
	public function showImage(&$_Data) {
		$html = '';
		if($_Image = Image::get($_Data->image,'name,title')) {
			$html = '<img class="article-image" src="'.__BASE__.'/image/'.urlencode($_Image->name).'" alt="'.htmlspecialchars($_Image->title,ENT_QUOTES|ENT_HTML5).'" />';
		}
		return $html;
	}
	
	// Shared function to show an item
	public function showItem(&$_Data) {
		$html = '<div class="article">';
		$html = '<h1 class="article-title">'.$this->showTitle($_Data).'</h1>';
		$html .= '<div class="article-body">'.$this->showBody($_Data).'</div>';
		return $html;
		$html .= '<div class="article-body">'.$this->showBody($_Data).'</div>';
		return $html;
	}
	
	// Shared function to show a list of items
	public function showList(&$_Data) {
		$html = '<ul class="item-list">';
		foreach($this->_Data as $item)
			$html .= '<li class="list-item">'.$this->showItem($item).'</li>';
		$html .= '</ul>';
		return $html;
	}
	
	// Shared function to show item heading in uniform way
	public function showTitle(&$_Data) {
		return '<h1 class="article-title">'.htmlspecialchars($_Data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
}
?>