<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class HeadPlugin extends Addon {
	// Generate metadata
	public static function getMetadata() {
		$html = '<title itemprop="name headline">'.Configuration::getParameter('title',Configuration::get('site-name','Cubo CMS')).'</title>'.PHP_EOL."\t";
		$html .= '<base itemprop="url" href="'.Configuration::getParameter('base-url',__BASE__).'" />'.PHP_EOL."\t";
		$html .= '<meta charset="utf-8" />'.PHP_EOL."\t";
		$html .= '<meta name="application_name" content="'.Configuration::get('site-name','Cubo CMS').'" />'.PHP_EOL."\t";
		$html .= '<meta name="author" itemprop="author" content="'.Configuration::getParameter('author','').'" />'.PHP_EOL."\t";
		$html .= '<meta name="creator" itemprop="creator" itemscope itemtype="https://schema.org/Organization" content="'.Configuration::getParameter('provider',"Papiando Riba Internet").'" />'.PHP_EOL."\t";
		$html .= '<meta name="description" itemprop="description" content="'.Configuration::getParameter('description','').'" />'.PHP_EOL."\t";
		$html .= '<meta name="generator" content="'.Configuration::getParameter('generator',"Cubo CMS by Papiando").'" />'.PHP_EOL."\t";
		$html .= '<meta name="keywords" itemprop="keywords" content="'.Configuration::getParameter('tags','').'" />'.PHP_EOL."\t";
		$html .= '<meta name="robots" content="index,follow" />'.PHP_EOL."\t";
		$html .= '<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />'.PHP_EOL."\t";
		return $html;
	}
	
	// Return list of stylesheets
	public static function getStylesheets() {
		$html = '';
		$_Stylesheets = Configuration::getStylesheets();
		foreach($_Stylesheets as $stylesheet) {
			$html .= '<link rel="stylesheet" href="'.$stylesheet.'" />'.PHP_EOL."\t";
		}
		return $html;
	}
	
	// Return list of scripts
	public static function getScripts() {
		$html = '';
		$_Scripts = Configuration::getScripts();
		foreach($_Scripts as $script) {
			$html .= '<script src="'.$script.'"></script>'.PHP_EOL."\t";
		}
		return $html;
	}
	
	// Replaces head tag with generated metatags, templates, and scripts that were added
	public static function render($html) {
		if($html) {
			return preg_replace("/<cubo:head\s*\/>/i",self::getMetadata().self::getStylesheets().self::getScripts(),$html);
		} else {
			return false;
		}
	}
}
?>