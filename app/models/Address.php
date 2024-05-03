<?php 
require_once "database.php";
class Address {
  public static function update($user_id, $address, $ward, $district, $city) {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "SELECT address_id FROM Users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $address_id = $row['address_id'];
      
      $sql = "UPDATE Addresses SET address = ?, ward = ?, district = ?, city = ? WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssi", $address, $ward, $district, $city, $address_id);
      $stmt->execute();
      $stmt->close();
    }
  }

  public static function create($user_id) {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "INSERT INTO Addresses (address, ward, district, city) VALUES (NULL, NULL, NULL, NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $new_address_id = $stmt->insert_id;
    
    $stmt->close();
    
    if ($new_address_id) {
        $sql = "UPDATE Users SET address_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_address_id, $user_id);
        $stmt->execute();
        $stmt->close();
    }
  }

  public static function get_address_by_id($address_id) {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "SELECT * FROM Addresses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("i", $address_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $address_data = $result->fetch_assoc();
        $stmt->close();
        return $address_data;
    } else {
        $stmt->close();
        return null;
    }
  }
}
?>
