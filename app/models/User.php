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

  public static function get_user_by_id($id) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM Users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
      }
    }
  }

  public static function upload_cv($postData, $user_id) {
    $uploadDirectory = __DIR__ . '/../data/cvs/';
    chmod($uploadDirectory, 0777);
    $fileName = $user_id . ".pdf";
    $filePath = $uploadDirectory . $fileName;
    move_uploaded_file($postData['cv']['tmp_name'], $filePath);
    if (file_exists($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        http_response_code(404);
        echo 'File not found.';
    }
  }
  
  public static function get_cv_by_id($user_id) {

  }
}
?>
