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
	// Determine whether there is a route defined
	$route = (defined('__ROUTE__') ? __ROUTE__ : null);
	// Set path names
	$frameworkPath = 'framework'.DS.$class.'.class.php';
	$modelPath = 'model'.DS.$class.'.model.php';
	$viewPath = 'view'.DS.str_replace('view','',$class).'.view.php';
	$controllerPath = 'controller'.DS.str_replace('controller','',$class).'.controller.php';
	// Include if file exists ($route enables override)
	if($route && file_exists(__ROOT__.DS.$route.DS.$frameworkPath))
		require_once(__ROOT__.DS.$route.DS.$frameworkPath);
	elseif(file_exists(__ROOT__.DS.$frameworkPath))
		require_once(__ROOT__.DS.$frameworkPath);
	elseif($route && file_exists(__ROOT__.DS.$route.DS.$modelPath))
		require_once(__ROOT__.DS.$route.DS.$modelPath);
	elseif(file_exists(__ROOT__.DS.$modelPath))
		require_once(__ROOT__.DS.$modelPath);
	elseif($route && file_exists(__ROOT__.DS.$route.DS.$viewPath) && strpos($class,'view') > 0)
		require_once(__ROOT__.DS.$route.DS.$viewPath);
	elseif(file_exists(__ROOT__.DS.$viewPath) && strpos($class,'view') > 0)
		require_once(__ROOT__.DS.$viewPath);
	elseif($route && file_exists(__ROOT__.DS.$route.DS.$controllerPath) && strpos($class,'controller') > 0)
		require_once(__ROOT__.DS.$route.DS.$controllerPath);
	elseif(file_exists(__ROOT__.DS.$controllerPath) && strpos($class,'controller') > 0)
		require_once(__ROOT__.DS.$controllerPath);
	try {
		if(!class_exists(__CUBO__.'\\'.$class,$false))
			throw new Error(['class'=>__CLASS__,'method'=>__METHOD__,'line'=>__LINE__,'file'=>__FILE__,'severity'=>1,'response'=>405,'message'=>"Class '{$class}' could not be loaded"]);
	} catch(Error $_Error) {
		$_Error->showMessage();
	}
});

	// Detect install; if .config.php does not exist, then assume that it's a fresh install
	new Application();
?>