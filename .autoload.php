<?php
namespace Cubo;

// Define global constants
defined('DS') || define('DS',DIRECTORY_SEPARATOR);
defined('__ROOT__') || define('__ROOT__',$_SERVER['DOCUMENT_ROOT']);
defined('__CUBO__') || define('__CUBO__',__NAMESPACE__);
defined('__BASE__') || define('__BASE__',sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST']));
defined('__VERSION__') || define('__VERSION__','2.0.0');

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
	$pluginPath = 'plugin'.DS.str_replace('plugin','',$class).'.plugin.php';
	$modulePath = 'module'.DS.str_replace('module','',$class).'.module.php';
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
	elseif($route && file_exists(__ROOT__.DS.$route.DS.$pluginPath) && strpos($class,'plugin') > 0)
		require_once(__ROOT__.DS.$route.DS.$pluginPath);
	elseif(file_exists(__ROOT__.DS.$pluginPath) && strpos($class,'plugin') > 0)
		require_once(__ROOT__.DS.$pluginPath);
	elseif($route && file_exists(__ROOT__.DS.$route.DS.$modulePath) && strpos($class,'module') > 0)
		require_once(__ROOT__.DS.$route.DS.$modulePath);
	elseif(file_exists(__ROOT__.DS.$modulePath) && strpos($class,'module') > 0)
		require_once(__ROOT__.DS.$modulePath);
});

	// Detect install; if .config.php does not exist, then assume that it's a fresh install
	new Application;
?>