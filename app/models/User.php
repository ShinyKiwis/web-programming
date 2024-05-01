<?php 
require_once "database.php";
require_once "CV.php";
require_once "Address.php";
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
      // Get newly created user id
      $user_id = $conn->insert_id;
      // Create emptyCV
      CV::create($user_id);
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
        $user_cv = CV::get_cv_by_id($id);
        $user_address = Address::get_address_by_id($user['address_id']);
        if($user_cv) {
          $user['cv'] = $user_cv;
          $user['address'] = $user_address;
        }
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
        exit(json_encode(array("message" => "Your CV is uploaded successfully.")));
    } else {
        http_response_code(404);
        echo 'File not found.';
    }
  }
  
  public static function get_cv_by_id($postData) {
    $user_id = $postData['user_id'];
    $cv_path = __DIR__ . "/../data/cvs/{$user_id}.pdf";
    if (file_exists($cv_path)) {
      $cv_content = file_get_contents($cv_path);
      $cv_content_base64 = base64_encode($cv_content);
      exit(json_encode(array("status" => "success", "cv" => $cv_content_base64))); 
    } else {
      exit(json_encode(array("status" => "error")));
    }
  }

  public static function update($postData) {
    $conn = Database::getInstance()->getConnection();
    $user_id = $postData['user_id'];

    // Data for address
    $address = $postData['address_address'];
    $city = $postData['address_city'];
    $district = $postData['address_district'];
    $ward = $postData['address_ward'];
    Address::create($user_id, $address, $ward, $district, $city);

    // Data for CV
    $careerGoal = $postData['career_goal'];
    $experiences = $postData['experiences'];
    $highestDegree = $postData['highest_degree'];
    $currentPosition = $postData['current_position'];
    $education = $postData['education'];
    $willingToRelocation = ($postData['willing_to_relocation'] === 'false') ? 0 : 1;
    $desiredJobLocation = $postData['desired_job_location'];
    $desiredJobSalary = $postData['desired_job_salary'];

    // Construct the SQL query to update the CV
    $sql = "UPDATE CVs SET 
                career_goal = ?, 
                experiences = ?, 
                highest_degree = ?, 
                current_position = ?, 
                education = ?, 
                willing_to_relocation = ?, 
                desired_job_location = ?, 
                desired_job_salary = ? 
            WHERE owner_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssssssi", 
                      $careerGoal, 
                      $experiences, 
                      $highestDegree, 
                      $currentPosition, 
                      $education, 
                      $willingToRelocation, 
                      $desiredJobLocation, 
                      $desiredJobSalary, 
                      $user_id);
    if($stmt->execute()) {
      header("Location: " . "http://localhost:8080/profile");
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
}
?>
