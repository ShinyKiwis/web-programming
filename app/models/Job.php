<?php 
require_once "database.php";

class Job {
  public static function create($postData) {
    $conn = Database::getInstance()->getConnection();
    $company_id = $postData['company_id'];
    $job_name = $postData['job'];
    $job_description = $postData['description'];
    $job_work_arrangement = $postData['work_arrangement'];
    $job_levels = $postData['level'];
    $salary = $postData['salary'] == 0 ? $postData['option'] : $postData['salary'];
    $expiration = $postData['enddate_hiring'];
    $benefits = $postData['benefits'];
    $location = $postData['address_city']; // Assuming 'address_city' holds the location value
    $requirements = $postData['requirements'];

    $sql = "INSERT INTO Jobs (company_id, name, description, work_arrangement, levels, salary, expiration, benefits, location, requirements) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssss", $company_id, $job_name, $job_description, $job_work_arrangement, $job_levels, $salary, $expiration, $benefits, $location, $requirements);

    if($stmt->execute()) {
        $stmt->close();
        return;
    } else {
        $stmt->close();
        return;
    }
  }
}
?>
