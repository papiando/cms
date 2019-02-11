<?php
namespace Cubo;

// Define global constants
define('DS',DIRECTORY_SEPARATOR);
define('__ROOT__',dirname(__FILE__));
define('__CUBO__',__NAMESPACE__);
define('__BASE__',sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST']));
define('__VERSION__','2.0.0');

// Auto-register classes
spl_autoload_register(function($class) {
	// Get the last part of the class (since all classes will have a namespace)
	$class = strtolower(basename(str_replace('\\','/',$class)));
	// Set path names
	$frameworkPath = __ROOT__.DS.'framework'.DS.$class.'.class.php';
	$modelPath = __ROOT__.DS.'model'.DS.$class.'.model.php';
	$viewPath = __ROOT__.DS.'view'.DS.str_replace('view','',$class).'.view.php';
	$controllerPath = __ROOT__.DS.'controller'.DS.str_replace('controller','',$class).'.controller.php';
	// Include if file exists
	if(file_exists($frameworkPath))
		require_once($frameworkPath);
	elseif(file_exists($modelPath))
		require_once($modelPath);
	elseif(file_exists($viewPath) && strpos($class,'view') > 0)
		require_once($viewPath);
	elseif(file_exists($controllerPath) && strpos($class,'controller') > 0)
		require_once($controllerPath);
});

	// Detect install; if .config.php does not exist, then assume that it's a fresh install
	new Application();
?>