<?php
  namespace Cubo\Framework;

  class Controller {
    // Static method to determine if controller exists
    public static function exists($controller) {
      $controllerClass = __CUBO__.'\\Controller\\'.ucfirst($controller);
      return class_exists($controllerClass);
    }

    // Static method to determine if controller's method exists
    public static function methodExists($controller, $method) {
      $controllerClass = __CUBO__.'\\Controller\\'.ucfirst($controller);
      return method_exists($controllerClass, $method);
    }
  }
?>
