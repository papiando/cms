<?php
  namespace Cubo\Controller;
  use Cubo\Framework\Controller;

  class Article extends Controller {
    // Method: all
    public function all() {
    }

    // Method: category
    public function category() {
    }

    // Method: default
    public function default() {
      $this->all();
    }

    // Method: read
    public function read() {
      $this->view();
    }

    // Method: status
    public function status() {
    }

    // Method: view
    public function view() {
    }
  }
?>
