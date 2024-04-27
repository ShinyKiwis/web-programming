<?php 
require_once "database.php";
class User {
  public static function get_user_by_email($email) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT * from Users where email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
      }
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
    return null;
  }
  
  public static function create($postData) {
    $conn = Database::getInstance()->getConnection();
    $username = $postData['username'];
    $email = $postData['email'];
    $password = $postData['password'];
    $type = $postData['userType'];
    if (!is_null(self::get_user_by_email($email))) {
      exit(json_encode(array("status" => "error", "message" => "Email already exists!")));
    }
    $sql = "INSERT INTO Users (username, password, email, type) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $type);

    if ($stmt->execute()) {
      $stmt->close();
      exit(json_encode(array("status" => "success")));
    } else {
      $stmt->close();
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>
