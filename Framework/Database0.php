<?php
  namespace Cubo\Framework;
  use MongoDB\Driver as Mongo;

  final class Database {
    private $connection;
    private $options;

    // Upon construct connect to database
    public function __construct($options = null) {
      $this->connect($options);
    }

    // Execute command
    public function command($command) {
      try {
        $command = new \MongoDB\Driver\Command($command);
        $items = $this->connection->executeCommand($this->options->get('database', __CUBO__), $command);
        return $items;
      } catch(\MongoDB\Exception\Exception $error) {
        // Do something
      }
    }

    // Connect to database
    public function connect($options = null) {
      $this->options = new Set($options);
      try {
        $this->connection = new \MongoDB\Driver\Manager($this->options->get('connection', 'mongodb://localhost:27017'));
      } catch(\MongoDB\Exception\Exception $error) {
        // Do something
      }
    }

    // Delete items
    public function delete($table, $filter) {
      try {
        $query = new \MongoDB\Driver\BulkWrite;
        $query->delete($filter);
        $this->connection->executeBulkWrite($this->options->get('database', __CUBO__).'.'.$table, $query);
      } catch(\MongoDB\Exception\Exception $error) {
        // Do something
      }
    }

    // Get items
    public function get($table, $filter = [], $options = []) {
      try {
        $query = new \MongoDB\Driver\Query($filter, $options);
        $items = $this->connection->executeQuery($this->options->get('database', __CUBO__).'.'.$table, $query);
        return $items;
      } catch(\MongoDB\Exception\Exception $error) {
        // Do something
      }
    }

    // Insert items
    public function insert($table, $data) {
      try {
        $query = new \MongoDB\Driver\BulkWrite;
        $query->insert($data);
        $this->connection->executeBulkWrite($this->options->get('database', __CUBO__).'.'.$table, $query);
      } catch(\MongoDB\Exception\Exception $error) {
        // Do something
      }
    }

    // Update items
    public function update($table, $filter, $data) {
      try {
        $query = new \MongoDB\Driver\BulkWrite;
        $query->update($filter, ['$set'=>$data]);
        $this->connection->executeBulkWrite($this->options->get('database', __CUBO__).'.'.$table, $query);
      } catch(\MongoDB\Exception\Exception $error) {
        // Do something
      }
    }
  }
?>
