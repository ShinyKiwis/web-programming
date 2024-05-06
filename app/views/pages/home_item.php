<div id="pagination-content" class="mx-5 d-flex gap-4 mt-4">
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
      $sql = " SELECT * FROM Companies where Companies.ID = " . $row["company_id"];//query tên công ty -> 
      $result_2 = $conn->query($sql);
      $row_company = $result_2->fetch_assoc();
      ?>
      <div class="col-md-9">
        <div class="card-body">
          <a href="#" class="card-title"><?php echo $row["name"]; ?></a>
          <p class="card-text"><?php echo $row_company["name"]; ?></p>
          <p class="card-text">
            <span class="text-danger">
            <?php echo ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]); ?>
            </span> | 
            <span>
            <?php echo $row["location"]; ?>
            </span>
          </p>
          <p class="card-text">
            <small class="text-body-secondary">
                <?php echo $row["expiration"]; ?>
            </small>
          </p>
          <?php
            echo '<div class="badge-container">';
            echo '<span class="badge rounded-pill badge-primary">' . $row['work_arrangement'] . '</span>';
            echo '<span class="badge rounded-pill badge-primary">' . $row['levels'] . '</span>';
            echo '</div>';
          ?>
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
      <div class="col-md-9">
        <div class="card-body">
          <?php
          $sql = "SELECT * FROM Tags INNER JOIN JobsTags ON Tags.id = JobsTags.tag_id where JobsTags.job_id =". $row["id"] ;//query JobsTags join với tag luôn -> 
          $result_3 = $conn->query($sql);
          ?>
          <a href="#" class="card-title"><?php echo $row["name"]; ?></a>
          <p class="card-text"><?php echo $row_company["name"]; ?></p>
          <p class="card-text">
            <span class="text-danger">
            <?php echo ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]); ?>
            </span> | 
            <span>
            <?php echo $row["location"]; ?>
            </span>
          </p>
          <p class="card-text">
            <small class="text-body-secondary">
                <?php echo $row["expiration"]; ?>
            </small>
          </p>
          <?php
            echo '<div class="badge-container">';
            echo '<span class="badge rounded-pill badge-primary">' . $row['work_arrangement'] . '</span>';
            echo '<span class="badge rounded-pill badge-primary">' . $row['levels'] . '</span>';
            echo '</div>';
          ?>
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
