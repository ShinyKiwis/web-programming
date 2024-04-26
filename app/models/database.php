<?php
class Database {
  private static $instance = null;
  private $conn;

  private function __construct() {
    $servername = 'mysql';
    $username = 'developer';
    $password = 'developer';
    $database = 'work_seekers';

    $this->conn = new mysqli($servername, $username, $password, $database);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection() {
      return $this->conn;
  }
}
?>
