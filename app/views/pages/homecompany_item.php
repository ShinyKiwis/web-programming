<div id="pagination-content" class="mx-5 d-flex gap-4">
  <div class="card mb-3 col px-4 py-2">
    <div class="row">
      <div class="col-md-3 d-flex justify-content-center align-items-center">
        <img 
          src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
          class="rounded-start" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <?php
      $sql = " SELECT * FROM Users where Users.ID = " . $row["owner_id"];//query tên công ty -> 
      $result_2 = $conn->query($sql);
      $row_user = $result_2->fetch_assoc();
      ?>
      <?php 
      $sql = "SELECT j.name
      FROM Jobs j
      INNER JOIN JobsCVs jc ON j.id = jc.job_id
      INNER JOIN CVs c ON jc.cv_id = c.id;";
      $result_3 = $conn->query($sql);
      $row_job = $result_3->fetch_assoc();
      ?>
      <div class="col-md-9">
        <div class="card-body">
          
        <a href="#" class="card-title"><?php echo $row_user["username"]; ?></a>
          <p class="card-text "><a style="font-weight:bold;">Position: </a><?php echo $row["current_position"]; ?></p>
          <p class="card-text text-danger"><a style="font-weight:bold;">Expected Salary: </a><?php echo $row["desired_job_salary"]; ?></p>
          <p class="card-text"><a style="font-weight:bold;">Location: </a><?php echo $row["location"]; ?></p>
          <p class="card-text"><a style="font-weight:bold;">Languages: </a><?php echo $row["languages"]; ?></p>
        </div>
      </div>
    </div>
  </div>
  <?php
  $num_rows = $num_rows - 1;
  if ($num_rows > 0) {
    // Fetch the next row
    $row = $result->fetch_assoc();
    $num_rows = $num_rows - 1;
  ?>
  <div class="card mb-3 col px-4 py-2">
    <div class="row">
      <div class="col-md-3 d-flex justify-content-center align-items-center">
        <img 
          src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
          class="rounded-start" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <?php
      $sql = " SELECT * FROM Users where Users.ID = " . $row["owner_id"];//query tên công ty -> 
      $result_2 = $conn->query($sql);
      $row_user = $result_2->fetch_assoc();
      ?>
      <?php 
      $sql = "SELECT j.name
      FROM Jobs j
      INNER JOIN JobsCVs jc ON j.id = jc.job_id
      INNER JOIN CVs c ON jc.cv_id = c.id;";
      $result_3 = $conn->query($sql);
      $row_job = $result_3->fetch_assoc();
      ?>
      <div class="col-md-9">
        <div class="card-body">
          
        <a href="#" class="card-title"><?php echo $row_user["username"]; ?></a>
          <p class="card-text "><a style="font-weight:bold;">Position: </a><?php echo $row["current_position"]; ?></p>
          <p class="card-text text-danger"><a style="font-weight:bold;">Expected Salary: </a><?php echo $row["desired_job_salary"]; ?></p>
          <p class="card-text"><a style="font-weight:bold;">Location: </a><?php echo $row["location"]; ?></p>
          <p class="card-text"><a style="font-weight:bold;">Languages: </a><?php echo $row["languages"]; ?></p>
        </div>
      </div>
    </div>
  </div>

  <?php 
  } 
  else {
    echo '<div class="mb-3 col px-4 py-2">';
    echo '</div>';
    echo '</div>';
    $loopFlag = false;
  }
  echo '</div>';
  ?>
</div>
