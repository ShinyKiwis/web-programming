<?php 
require_once "database.php";
class Company {
  public static function update($postData) {
    $conn = Database::getInstance()->getConnection();
    $user_id = $postData['user_id'];

    // Data for company
    $name = $postData['company_name'];
    $description = $postData['company_description'];
    $size = $postData['company_size'];
    $contact_info = $postData['company_contact_info'];
    self::create($user_id, $name, $description, $size, $contact_info)

    // Data for address
    $address = $postData['address_address'];
    $city = $postData['address_city'];
    $district = $postData['address_district'];
    $ward = $postData['address_ward'];
    Address::update($user_id, $address, $ward, $district, $city);

    
  }

  public static function create($user_id, $name, $description, $size, $contact_info) {
    
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

}
?>
