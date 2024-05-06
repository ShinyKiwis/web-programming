<?php
class PagesController {
  const DEFAULT_VIEW_FOLDER = 'views/pages/';
  public function home() {
    require_once ('models/database.php');

    $instance = Database::getInstance();
    $conn = $instance->getConnection();
    //if user -> goi home_user else home_company
    return PagesController::home_user($conn);
    // return PagesController::home_company($conn);
  }
  public function candidate() {
    require_once ('models/database.php');

    $instance = Database::getInstance();
    $conn = $instance->getConnection();
    //if user -> goi home_user else home_company
    return PagesController::home_company($conn);
    // return PagesController::home_company($conn);
  }

  public function display($result) {
    $instance = Database::getInstance();
  
    $conn = $instance->getConnection();
    
    // Process the result set
    $num_rows = $result->num_rows;
    if ($num_rows > 0) {
      $loopFlag = true;
      while($row = $result->fetch_assoc()) {
        // print_r($row);

        
        // echo '<div id="pagination-content" class="mx-5 d-flex gap-4">';
        // echo '<div class="card mb-3 col px-4 py-2">';
        // echo '<div class="row">';
        // echo '<div class="col-md-3 d-flex justify-content-center align-items-center">';
        // echo '<img 
        //         src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
        //         class="rounded-start" 
        //         alt="company logo" 
        //         style="width: 8em; height: 8em;"
        //       />';
        // echo '</div>';
        // $sql = " SELECT * FROM Companies where Companies.ID = " . $row["company_id"];//query tên công ty -> 
        // $result_2 = $conn->query($sql);
        // $row_company = $result_2->fetch_assoc();
        // echo '<div class="col-md-9">';
        // echo '<div class="card-body">';
        
  
        // $sql = "SELECT * FROM Tags INNER JOIN JobsTags ON Tags.id = JobsTags.tag_id where JobsTags.job_id =". $row["id"] ;//query JobsTags join với tag luôn -> 
        // $result_3 = $conn->query($sql);
        // echo '<a href="#" class="card-title">' . $row["name"] . '</a>';
        // echo '<p class="card-text">' . $row_company["name"] . '</p>';
        // echo '<p class="card-text"><span class="text-danger">' . ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]) . '</span> | <span>' . $row["location"] . '</span></p>';
        // echo '<p class="card-text"><small class="text-body-secondary">' . $row["expiration"] . '</small></p>';
        // if ($result_3->num_rows > 0) {
        //   // Start the badge container
        //   echo '<div class="badge-container">';
          
        //   // Fetch and display each associated tag
        //   while ($row_tag = $result_3->fetch_assoc()) {
        //       // Generate HTML for each tag
        //       echo '<span class="badge rounded-pill badge-primary">' . $row_tag['name'] . '</span>';
        //   }
          
        //   // End the badge container
        //   echo '</div>';
        // }
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
        // $num_rows = $num_rows - 1;
        // if ($num_rows > 0) {
        //   // Fetch the next row
        //   $row = $result->fetch_assoc();
        //   $num_rows = $num_rows - 1;
        //   echo '<div class="card mb-3 col px-4 py-2">';
        //   echo '<div class="row">';
        //   echo '<div class="col-md-3 d-flex justify-content-center align-items-center">';
        //   echo '<img 
        //           src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
        //           class="rounded-start" 
        //           alt="company logo" 
        //           style="width: 8em; height: 8em;"
        //         />';
        //   echo '</div>';
        //   $sql = " SELECT * FROM Companies where Companies.ID = " . $row["company_id"];//query tên công ty -> 
        //   $seresult = $conn->query($sql);
        //   $row_company = $seresult->fetch_assoc();
        //   echo '<div class="col-md-9">';
        //   echo '<div class="card-body">';
        //   $sql = "SELECT * FROM Tags INNER JOIN JobsTags ON Tags.id = JobsTags.tag_id where JobsTags.job_id =". $row["id"] ;//query JobsTags join với tag luôn -> 
        //   $result_3 = $conn->query($sql);
        //   echo '<a href="#" class="card-title">' . $row["name"] . '</a>';
        //   echo '<p class="card-text">' . $row_company["name"] . '</p>';
        //   echo '<p class="card-text"><span class="text-danger">' . ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]) . '</span> | <span>' . $row["location"] . '</span></p>';
        //   echo '<p class="card-text"><small class="text-body-secondary">' . $row["expiration"] . '</small></p>';
        //   if ($result_3->num_rows > 0) {
        //     // Start the badge container
        //     echo '<div class="badge-container">';
            
        //     // Fetch and display each associated tag
        //     while ($row_tag = $result_3->fetch_assoc()) {
        //         // Generate HTML for each tag
        //         echo '<span class="badge rounded-pill badge-primary">' . $row_tag['name'] . '</span>';
        //     }
            
        //     // End the badge container
        //     echo '</div>';
        //   }
        //   echo '</div>';
        //   echo '</div>';
        //   echo '</div>';
        //   echo '</div>';
        // }
        // else {
        //     echo '<div class="mb-3 col px-4 py-2">';
        //     echo '</div>';
        //     echo '</div>';
        //     break;
        //   }
        // echo '</div>';


        include(self::DEFAULT_VIEW_FOLDER . 'home_item.php');
        if (!$loopFlag) {
          break;
        }   
      }
    } else {
      echo "0 results";
    }
  
    // Close database connection
    // $conn->close();
  }
  
  public function home_user($conn) {
    $page = isset($_GET['num']) ? $_GET['num'] : 1;
    $limit = 30;
    $start = ($page - 1) * $limit;
    if($start < 0) {
      $start = 0;
    }
    $result;
    $result1;
    
    if (!isset($_GET['job_name']) && !isset($_GET['location']) && !isset($_GET['work_arrangement']) && !isset($_GET['level'])){
      $result = $conn->query("SELECT * FROM Jobs LIMIT $start, $limit");
      $result1 = $conn->query("SELECT count(id) AS id FROM Jobs");
    }
    else{
      $jobname = $_GET['job_name'];
      $location = $_GET['location'];
      $work_arrangement = $_GET['work_arrangement'];
      $levels = $_GET['level'];
      $result = $conn->query("SELECT * FROM Jobs WHERE name LIKE '$jobname%'" ." AND location LIKE '%$location%'" . " AND work_arrangement LIKE '%$work_arrangement%'" ." AND levels LIKE '%$levels%'"."LIMIT $start, $limit");
      $result1 = $conn->query("SELECT count(id) AS id FROM Jobs WHERE name LIKE '$jobname%' " ." AND location LIKE '%$location%'". " AND work_arrangement LIKE '%$work_arrangement%'" . " AND levels LIKE '%$levels%'");
    }
    
    $custCount = $result1->fetch_all(MYSQLI_ASSOC);
    $total = $custCount[0]['id'];
    $pages = ceil( $total / $limit );
    
    $Previous = $page - 1;
    $Next = $page + 1;

    ob_start();
    PagesController::display($result);

    include(self::DEFAULT_VIEW_FOLDER . 'home.php');
    $content = ob_get_clean();
    return $content;

  }
  
  public function home_company($conn) {
    $page = isset($_GET['num']) ? $_GET['num'] : 1;
    $limit = 30;
    $start = ($page - 1) * $limit;
    if($start < 0) {
      $start = 0;
    }
    $result;
    $result1;
    if (!isset($_GET['job_name']) && !isset($_GET['desired_job_location']) && !isset($_GET['work_arrangement']) && !isset($_GET['level'])){
      $result = $conn->query("SELECT * FROM CVs LIMIT $start, $limit");
      $result1 = $conn->query("SELECT count(id) AS id FROM CVs");
    }
    else{
      $jobname = $_GET['job_name'];
      $desired_job_location = $_GET['desired_job_location'];
      $work_arrangement = $_GET['work_arrangement'];
      $levels = $_GET['level'];
      $result = $conn->query("SELECT *
      FROM Jobs j
      INNER JOIN JobsCVs jc ON j.id = jc.job_id
      INNER JOIN CVs c ON jc.cv_id = c.id
      WHERE j.name LIKE '$jobname%'" ." AND c.desired_job_location LIKE '%$desired_job_location%'" . " AND j.work_arrangement LIKE '%$work_arrangement%'" ." AND j.levels LIKE '%$levels%'" ."LIMIT $start, $limit");
      $result1 = $conn->query("SELECT count(c.id) AS id FROM Jobs j
      INNER JOIN JobsCVs jc ON j.id = jc.job_id
      INNER JOIN CVs c ON jc.cv_id = c.id
      WHERE j.name LIKE '$jobname%'" ." AND c.desired_job_location LIKE '%$desired_job_location%'". " AND j.work_arrangement LIKE '%$work_arrangement%'" ." AND j.levels LIKE '%$levels%'");
    }
    
    $custCount = $result1->fetch_all(MYSQLI_ASSOC);
    $total = $custCount[0]['id'];
    $pages = ceil( $total / $limit );
    
    $Previous = $page - 1;
    $Next = $page + 1;

    ob_start();
    PagesController::display_company($result);

    include(self::DEFAULT_VIEW_FOLDER . 'candidates.php');
    $content = ob_get_clean();
    return $content;

  }

  public function display_company($result) {
    $instance = Database::getInstance();
  
    $conn = $instance->getConnection();
    
    // Process the result set
    $num_rows = $result->num_rows;
    if ($num_rows > 0) {
      $loopFlag = true;
      while($row = $result->fetch_assoc()) {
        include(self::DEFAULT_VIEW_FOLDER . 'homecompany_item.php');
        if (!$loopFlag) {
          break;
        }   
      }
    } else {
      echo "0 results";
    }
  }

}
?>
