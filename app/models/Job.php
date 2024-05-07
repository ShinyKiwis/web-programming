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

  public static function get_job_by_id($jobId) {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "SELECT * FROM Jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $job = $result->fetch_assoc();
            $stmt->close();
            return $job;
        }
    }

    return null;
  }

  public static function getAllListedJobs($company_id) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM Jobs WHERE company_id = ?";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("i", $company_id);
    
    if ($stmt->execute()) {
      $result = $stmt->get_result();
      
      $jobs = array();
      
      while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
      }
      
      $stmt->close();
      
      return $jobs;
    } else {
      error_log("Error executing query: " . $stmt->error);
      return null;
    }
  }

  public static function getAppliedCandidates($job_id) {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "SELECT JobsCVs.cv_id, Users.username FROM JobsCVs LEFT JOIN Users ON JobsCVs.cv_id = Users.id WHERE JobsCVs.job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);

    $appliedCandidates = [];

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $appliedCandidates[] = $row;
        }
        
        $stmt->close();
        return $appliedCandidates;
    }

    return [];
  }

  public static function getJob($job_id) {
    $conn = Database::getInstance()->getConnection();

    $sql = "SELECT Jobs.*, JobsCVs.cv_id FROM Jobs LEFT JOIN JobsCVs ON Jobs.id = JobsCVs.job_id WHERE Jobs.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
        $stmt->close();
        return $job;
    } else {
        return null;
    }
  }
}
?>
