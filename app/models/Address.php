<?php 
require_once "database.php";
class Address {
  public static function create($user_id, $address, $ward, $district, $city) {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "INSERT INTO Addresses (address, ward, district, city) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("ssss", $address, $ward, $district, $city);
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
    return;
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
