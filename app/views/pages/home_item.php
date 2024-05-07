<div id="pagination-content" class="mx-5 d-flex gap-4 mt-4">
  <div class="card mb-3 col px-4 py-2">
    <div class="row">
      <div class="col-md-3 d-flex justify-content-center align-items-center">
        <img 
          src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
          class="rounded" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <a href="/job?job=<?php echo $row["id"];?>" class="card-title"><?php echo $row["name"]; ?></a>
          <p class="card-text">
            <span class="text-danger">
            <?php echo ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]); ?>
            </span> | 
            <span class="city-name">
            <?php echo $row["location"]; ?>
            </span>
          </p>
          <p class="card-text text-body-secondary d-flex align-items-center gap-2">
            <i class="fa-solid fa-calendar"></i>
            <span><?php echo $row["expiration"]; ?></span>
          </p>
          <?php
            echo '<div class="badge-container">';
            echo '<span class="badge rounded-pill badge-primary">' . $row['work_arrangement'] . '</span>';
            echo '<span class="badge rounded-pill badge-primary ms-2">' . $row['levels'] . '</span>';
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
          class="rounded" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <a href="/job?job=<?php echo $row["id"];?>" class="card-title"><?php echo $row["name"]; ?></a>
          <p class="card-text">
            <span class="text-danger">
            <?php echo ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]); ?>
            </span> | 
            <span class="city-name">
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
            echo '<span class="badge rounded-pill badge-primary ms-2">' . $row['levels'] . '</span>';
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
