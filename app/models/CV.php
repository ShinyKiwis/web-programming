<?php 
require_once "database.php";
class CV {
  public static function create($user_id) {
    $conn = Database::getInstance()->getConnection();
    $sql = "INSERT INTO CVs (owner_id) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if($stmt->execute()) {
      $stmt->close();
      return;
    } else {
      $stmt->close();
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>
