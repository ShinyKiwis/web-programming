<?php
require_once ('models/database.php');

$instance = Database::getInstance();

$conn = $instance->getConnection();

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Example query
$sql = "SELECT * FROM Jobs";
$result = $conn->query($sql);

// Process the result set
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    // print_r($row);
    echo '<div id="pagination-content" class="mx-5 d-flex gap-4">';
    echo '<div class="card mb-3 col px-4 py-2">';
    echo '<div class="row">';
    echo '<div class="col-md-3 d-flex justify-content-center align-items-center">';
    echo '<img 
            src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
            class="rounded-start" 
            alt="company logo" 
            style="width: 8em; height: 8em;"
          />';
    echo '</div>';
    $sql = " SELECT * FROM Companies where Companies.ID = " . $row["company_id"];//query tên công ty -> 
    $seresult = $conn->query($sql);
    $row_company = $seresult->fetch_assoc();
    echo '<div class="col-md-9">';
    echo '<div class="card-body">';
    

    // $sql = "SELECT * FROM Tags INNER JOIN Jobtags ON Tags.ID = Jobtags.tag_id where Jobtags.job_id = row["id"]" //query jobtags join với tag luôn -> 
    // $thresult = $conn->query($sql)
    echo '<a href="#" class="card-title">' . $row["name"] . '</a>';
    echo '<p class="card-text">' . $row_company["name"] . '</p>';
    echo '<p class="card-text"><span class="text-danger">' . ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]) . '</span> | <span>' . $row["location"] . '</span></p>';
    echo '<p class="card-text"><small class="text-body-secondary">' . $row["expiration"] . '</small></p>';
    echo '<span class="badge rounded-pill badge-primary">Unity</span>';
    echo '<span class="badge rounded-pill badge-primary">Algorithm</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    if ($result->num_rows > 1) {
      // Fetch the next row
      $row = $result->fetch_assoc();

    echo '<div class="card mb-3 col px-4 py-2">';
    echo '<div class="row">';
    echo '<div class="col-md-3 d-flex justify-content-center align-items-center">';
    echo '<img 
            src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
            class="rounded-start" 
            alt="company logo" 
            style="width: 8em; height: 8em;"
          />';
    echo '</div>';
    $sql = " SELECT * FROM Companies where Companies.ID = " . $row["company_id"];//query tên công ty -> 
    $seresult = $conn->query($sql);
    $row_company = $seresult->fetch_assoc();
    echo '<div class="col-md-9">';
    echo '<div class="card-body">';
    echo '<a href="#" class="card-title">' . $row["name"] . '</a>';
    echo '<p class="card-text">Ubisoft</p>';
    echo '<p class="card-text"><span class="text-danger">' . ($row["salary"] == '' ? "Salary Negotiation" : $row["salary"]) . '</span> | <span>' . $row["location"] . '</span></p>';
    echo '<p class="card-text"><small class="text-body-secondary">' . $row["expiration"] . '</small></p>';
    echo '<span class="badge rounded-pill badge-primary">Unity</span>';
    echo '<span class="badge rounded-pill badge-primary">Algorithm</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    }
    echo '</div>';
  
    // echo '<div class="card-body">';
    // echo '<a href="#" class="card-title">Senior Game Engineer</a>';
    // echo '<p class="card-text">' . $row["name"] . '</p>';
    // echo <p class="card-text"><span class="text-danger">Salary Negotiation</span> | <span>Ho Chi Minh City</span></p>
    // echo <p class="card-text"><small class="text-body-secondary">Last updated: Today</small></p>
    // echo <span class="badge rounded-pill badge-primary">Unity</span>
    // echo <span class="badge rounded-pill badge-primary">Algorithm</span>
    // echo "</div>"

  }
} else {
  echo "0 results";
}

// Close database connection
$conn->close();

?>
<style>
  /* Some basic styling */
  .pagination-container {
    display: flex;
    justify-content: center;
  }
  .pagination-container .pagination {
    display: flex;
    list-style: none;
    padding: 0;
  }
  .pagination-container .pagination li {
    margin: 0 5px;
    cursor: pointer;
  }
</style> 
<div class="pagination-container">
  <ul class="pagination"></ul>
</div>
<script>
$(document).ready(function() {
  var itemsPerPage = 30; 
  var $items = $('#pagination-content .card');
  var itemCount = $items.length; 
  var pageCount = Math.ceil(itemCount / itemsPerPage); 
  function showPage(page) {
    var startIndex = (page - 1) * itemsPerPage;
    var endIndex = Math.min(startIndex + itemsPerPage, itemCount);
    $items.css({
    'display': 'none',
    });
    $items.slice(startIndex, endIndex).show();
  }
  showPage(1);
  function generatePagination() {
    var $pagination = $('.pagination');
    $pagination.empty();
    $pagination.append('<li class="page-item prev"><a class="page-link" href="#">Previous</a></li>');
    for (var i = 1; i <= pageCount; i++) {
      $pagination.append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
    }
    $pagination.append('<li class="page-item next"><a class="page-link" href="#">Next</a></li>');
    $pagination.find('li').eq(1).addClass('active');
  }
  generatePagination();
  $('.pagination').on('click', 'a', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $parent = $this.parent();
    if (!$parent.hasClass('active') && !$parent.hasClass('prev') && !$parent.hasClass('next')) {
      var page = parseInt($this.text());
      showPage(page);
      $('.pagination li').removeClass('active');
      $parent.addClass('active');
    } else if ($parent.hasClass('prev')) {
      var currentPage = $('.pagination li.active a').text();
      if (currentPage > 1) {
        showPage(parseInt(currentPage) - 1);
        $('.pagination li.active').removeClass('active').prev().addClass('active');
      }
    } else if ($parent.hasClass('next')) {
      var currentPage = $('.pagination li.active a').text();
      if (currentPage < pageCount) {
        showPage(parseInt(currentPage) + 1);
        $('.pagination li.active').removeClass('active').next().addClass('active');
      }
    }
  });
});
</script>
 




























