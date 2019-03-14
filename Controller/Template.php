<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          Template
 * @version        2.1.0
 * @date           2019-03-12
 * @author         Dan Barto
 * @copyright      Copyright (c) 2019 Cubo CMS; see COPYRIGHT.md
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo\Controller;
use Cubo\Framework\Controller;

class Template extends Controller {
	protected $columns = "name,accesslevel,script,status,style";
	
	// Minify CSS to speed up loading
	private static function minifyCSS($css){
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		$css = str_replace(': ', ':', $css);
		$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
		$css = str_replace(';}', '}', $css);
		return $css;
	}
	
	// Minify JavaScript to speed up loading
	private static function minifyJS($script){
		$script = preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $script);
		return $script;
	}
	
	// Template has no view, just return output
	protected function render($Data) {
		return $Data->script ?? $Data->style ?? false;
	}
	
	// Method to retrieve script
	public function script() {
		$this->columns = "accesslevel,script,status";
		$output = $this->view();
		// Preset headers
		header("Cache-Control: public");
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
		header("Content-type: text/css");
		// Return output; parameter 'minify' minimises output
		if(isset($_GET['minify']))
			return self::minifyJS($output);
		else
			return $output;
	}
	
	// Method to retrieve stylesheet
	public function stylesheet() {
		$this->columns = "accesslevel,status,style";
		$output = $this->view();
		// Preset headers
		header("Cache-Control: public");
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
		header("Content-type: text/css");
		// Return output; parameter 'minify' minimises output
		if(isset($_GET['minify']))
			return self::minifyCSS($output);
		else
			return $output;
	}
}
?>