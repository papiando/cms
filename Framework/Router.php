<?php
  namespace Cubo\Framework;

  final class Router {
    public $params;
    private $routes;

    // Upon construct initialise router
    public function __construct($routes) {
      $this->init($routes);
    }

    // Initialise router
    public function init($routes) {
      $this->routes = $routes;
    }

    // Invoke controller's method
    public function invokeMethod() {
      try {
        if(Controller::exists($this->params->get('controller', 'undefined'))) {
          echo '<p>Controller found!</p>';
          if(Controller::methodExists($this->params->get('controller', 'undefined'), $this->params->get('method', 'default'))) {
            echo '<p>Method found!</p>';
          } else {
            throw new Error(['message'=>'method-does-not-exist', 'params'=>$this->params]);
          }
        } else {
          throw new Error(['message'=>'controller-does-not-exist', 'params'=>$this->params]);
        }
      } catch(Error $error) {
          $error->render();
      }
    }

    // Parse route
    public function parse($url, $routes = null) {
      is_null($routes) || $this->$routes = $routes;
      // Expand url and match to route list
      foreach($this->routes as $route) {
        $parts = explode('/', trim(parse_url($url, PHP_URL_PATH), '/'));
        $params = new Set();
        if(count($parts) == count($route->parts)) {
          $matched = true;
          for($n = 0; $n < count($parts); $n++) {
            if($parts[$n] == $route->parts[$n]) {
              // Do nothing
            } elseif(Set::isVariable($route->parts[$n])) {
              $params->set($route->parts[$n], $parts[$n]);
            } else {
              $matched = false;
            }
          }
          if($matched) {
            $route->params->merge($params);
            return $this->params = new Set($route->params->getParams());
          }
        }
      }
    }
  }
?>
