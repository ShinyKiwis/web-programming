<?php 
require_once "database.php";
require_once "Address.php";
require_once "User.php";
class Company {
  public static function update($postData) {
    $conn = Database::getInstance()->getConnection();
    $user_id  = $postData['user_id'];
    $company_id = $postData['company_id'];
    $company_size = $postData['company_size'];
    $company_description = $postData['description'];

    $company_address = $postData['address_address'];
    $company_address_city = $postData['address_city'];
    $company_address_district = $postData['address_district'];
    $company_address_ward = $postData['address_ward'];

    Address::update($user_id, $company_address, $company_address_ward, $company_address_district, $company_address_city);

    $sql = "UPDATE Companies SET size = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $company_size, $company_description, $company_id);
    if($stmt->execute()) {
        // session_start();
        $_SESSION['user'] = User::get_user_by_id($user_id);
        header("Location: " . "http://localhost:8080/company/profile");
        $stmt->close();
        return;
    } else {
        $stmt->close();
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  public static function create($user_id) {
    $conn = Database::getInstance()->getConnection();
    $sql = "INSERT INTO Companies (owner_id) VALUES (?)";
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

  public static function get_company_by_owner_id($owner_id) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM Companies WHERE owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $owner_id);

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
