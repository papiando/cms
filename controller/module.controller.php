<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ModuleController extends Controller {
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
	
	// Theme has no view, just return output
	protected function render($_Data) {
		return $_Data->script ?? $_Data->style ?? false;
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