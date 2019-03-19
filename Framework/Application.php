<?php
  namespace Cubo\Framework;

  final class Application {
    public $configuration;
    public $default;
    public $parts;
    private $routes;

    // Upon construct initialise the application
    public function __construct($config = null) {
      $this->init($config);
    }

    // Allow returning configuration as JSON
    public function __toString() {
      return json_encode($this->configuration, JSON_PRETTY_PRINT);
    }

    // Add a new route
    public function addRoute($path, $params = null) {
      is_null($this->routes) && $this->routes = [];
      $this->routes[] = new Route($path, $params);
    }

    // Get configuration parameter
    public function get($property, $default) {
      is_null($this->configuration) && $this->configuration = new Set();
      return $this->configuration->get($property, $default);
    }

    // Retrieve all routes
    public function getRoutes() {
      return $this->routes ?? [];
    }

    // Initialise the application
    public function init($config = null) {
      // Load configuration
      $this->configuration = new Set($config);
    }

    // Start the application
    public function run() {
      $this->default = new Set();
      $this->parts = new Parser($_SERVER['REQUEST_URI']);
    }

    // Set configuration parameter
    public function set($property, $value) {
      is_null($this->configuration) && $this->configuration = new Set();
      $this->configuration->set($property, $value);
    }
  }
?>
