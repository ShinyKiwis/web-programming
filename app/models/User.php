<?php 
require_once "database.php";
class User {
  public static function create($postData) {
    $conn = Database::getInstance()->getConnection();
    $username = $postData['username'];
    $email = $postData['email'];
    $password = $postData['password'];
    $type = $postData['userType'];
    $sql = "INSERT INTO Users (username, password, email, type) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $type);

    if ($stmt->execute()) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>
