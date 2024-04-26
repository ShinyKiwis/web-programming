<?php 
require_once "database.php";
class User {
  public static function create($postData) {
    $conn = Database::getInstance()->getConnection();
    var_dump($postData);
  }
}
?>
