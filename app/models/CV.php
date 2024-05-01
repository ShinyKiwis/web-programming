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

  public static function get_cv_by_id($user_id) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM CVs WHERE owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $cv_data = $result->fetch_assoc();
            $stmt->close();
            return $cv_data;
        } else {
            $stmt->close();
            return null;
        }
    } else {
        $stmt->close();
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
  }
}
?>
