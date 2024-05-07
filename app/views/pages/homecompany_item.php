<div id="pagination-content" class="mx-5 d-flex gap-4 mt-4">
  <div class="card mb-3 col px-4 py-2">
    <div class="row">
      <div class="col-md-3 d-flex justify-content-center align-items-center">
        <img 
          src="https://images.unsplash.com/photo-1634896941598-b6b500a502a7?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
          class="rounded" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <?php
      $sql = " SELECT * FROM Users where Users.ID = " . $row["owner_id"];
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
          
          <a href="/cv?cv=<?php echo $row["owner_id"];?>" class="card-title"><?php echo $row_user["username"]; ?></a>
          <p class="card-text "><a style="font-weight:bold;">Position: </a><?php echo $row["current_position"]; ?></p>
          <p class="card-text text-danger"><a style="font-weight:bold;">Expected Salary: </a><?php echo $row["desired_job_salary"]; ?></p>
          <p class="card-text"><a style="font-weight:bold;">Location: </a><span class="city-name"><?php echo $row["desired_job_location"]; ?></span></p>
          <p class="card-text"><a style="font-weight:bold;">Languages: </a><?php $languages = $row["languages"];

// Check if $languages is not null and not empty
if ($languages !== null && $languages !== '') {
    // Split the string into an array using '@' as the delimiter
    $language_pairs = explode('@', $languages);

    // Initialize an empty array to store the formatted strings
    $formatted_languages = array();

    // Loop through each pair in the array
    foreach ($language_pairs as $pair) {
        // Split the pair into individual parts
        $parts = explode(' ', $pair);

        // Join the parts with space
        $formatted_pair = implode(' ', $parts);

        // Add the formatted pair to the result array
        $formatted_languages[] = $formatted_pair;
    }

    // Output the formatted strings
    echo implode(', ', $formatted_languages);
} else {
    // Handle case where $row["languages"] is null or empty
    echo "No languages specified";
}


 ?></p>
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
          src="https://images.unsplash.com/photo-1634896941598-b6b500a502a7?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
          class="rounded" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <?php
      $sql = " SELECT * FROM Users where Users.ID = " . $row["owner_id"];
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
          
          <a href="/cv?cv=<?php echo $row["owner_id"];?>" class="card-title"><?php echo $row_user["username"]; ?></a>
          <p class="card-text "><a style="font-weight:bold;">Position: </a><?php echo $row["current_position"]; ?></p>
          <p class="card-text text-danger"><a style="font-weight:bold;">Expected Salary: </a><?php echo $row["desired_job_salary"]; ?></p>
          <p class="card-text"><a style="font-weight:bold;">Location: </a><span class="city-name"><?php echo $row["desired_job_location"]; ?></span></p>

          <p class="card-text"><a style="font-weight:bold;">Languages: </a><?$languages = $row["languages"];

if ($languages !== null && $languages !== '') {

    $language_pairs = explode('@', $languages);

    $formatted_languages = array();

    foreach ($language_pairs as $pair) {

        $parts = explode(' ', $pair);

        $formatted_pair = implode(' ', $parts);


        $formatted_languages[] = $formatted_pair;
    }

    echo implode(', ', $formatted_languages);
} else {

    echo "No languages specified";
}

 ?></p>
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
<script>
function getCities() {
  $.ajax({
    url: "http://localhost:8080/data/address.json",
    method: "GET",
    dataType: "json",
    success: function(data) {
      const cities = Object.values(data);
      updateCityNames(cities);
    }
  })
}

function updateCityNames(cities) {
  $(".city-name").each(function(_, item) {
    const cityKey = item.innerText;
    const cityName = getCityName(cityKey, cities)
    item.innerText = cityName
  });
}
function getCityName(cityKey) {
  return cities.find(city => city.slug == cityKey).name_with_type
}

$(document).ready(function() {
  getCities();
});
</script>
