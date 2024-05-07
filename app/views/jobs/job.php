<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$work_arrangement_map = array(
    'onsite' => 'On site',
    'remote' => 'Remote',
    'hybrid' => 'Hybrid'
);

$level_map = array(
    'intern' => 'Intern/Student',
    'fresher' => 'Fresher/Entry level',
    'experienced' => 'Experienced (non-manager)',
    'manager' => 'Manager',
    'director' => 'Director and above'
);
?>
<div class="row mt-4 px-5">
  <div class="col-12 p-4 h-100" id="profile">
  <form id="update-form" action="/post_index.php" method="POST">
    <div class="row" id="profile-header">
      <div class="col-2  d-flex justify-content-center">
        <img id="avatarImg" 
            src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
            alt="profile avatar"
            style="border-radius: 9999px; width: 200px; height: 200px;"
        />
      </div>
      <div class="col-10">
        <p class="fs-4 fw-medium"><?php echo $job['name'] ?></p>
        <div class="row">
          <div class="col-10">
            <p><i class="fa-solid fa-calendar"></i><?php echo date('d/m/Y', strtotime($job['expiration'])); ?></p>
            <p><i class="fa-solid fa-envelope"></i><?php echo $job['email'] ?></p>
            <div class="d-flex gap-4">
              <p>
                <i class="fa-solid fa-location-dot"></i>
                <span class="city-name">
                  <?php echo $job['location']; ?>
                </span>
              </p>
              <p><strong>Work Arrangement:</strong><span><?php echo $work_arrangement_map[$job['work_arrangement']]; ?></span></p>
              <p><strong>Level:</strong><span><?php echo $level_map[$job['levels']]; ?></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section mt-4" id="description">
      <p>Description</p>
      <p><?php echo $job['description']; ?></p>
    </div> 
    <div class="profile-section" id="requirements">
      <p>Requirements</p>
      <ul id="requirementList">
      </ul>
      <p class="prompt">Edit to add requirements</p>
    </div>
    <div class="profile-section" id="salary">
      <p>Salary</p>
      <p>$<?php echo $job['salary']?></p>
    </div> 
    <div class="profile-section mt-2" id="benefit">
      <p>Benefit</p>
      <ul id="benefitList">
      </ul>
      <p class="prompt">Edit to add benefits</p>
    </div>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'candidate' && $job['cv_id'] != $_SESSION['user_id']): ?>
      <input type="hidden" name="user_id" id="user_id" value=<?php echo $_SESSION['user']['id'] ?>>
      <input type="hidden" name="job_id" id="user_id" value=<?php echo $job['id'] ?>>
      <input type="hidden" name="action" value="apply_job">
      <button type="submit" id="submit_btn" class="btn btn-primary mt-2 float-end">Apply</button>
    <?php endif; ?>
</form>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'employer' && $_SESSION['user']['company']['id'] == $job['company_id']): ?>
      <div class="profile-section mt-2" id="applications">
        <p>Applied Candidates</p>
        <?php foreach($applied_candidates as $candidate ) { ?>
          <a href="/cv?cv=<?php echo $candidate['cv_id']?>"><?php echo $candidate['username']; ?></a>
        <?php } ?>
      </div>
    <?php endif; ?>
  </div>
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
function getCityName(cityKey, cities) {
  return cities.find(city => city.slug == cityKey).name_with_type
}

$(document).ready(function() {
  getCities();
});
const requirements = `<?php echo $job['requirements']; ?>`;
const benefits = `<?php echo $job['benefits']; ?>`;
if(requirements.split("@").length > 0) {
  $("#requirements .prompt").remove();
}

if(benefits.split("@").length > 0) {
  $("#benefit .prompt").remove();
}

requirements.split("@").forEach(requirement => {
  $('#requirementList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + requirement + '</li>');
})

benefits.split("@").forEach(benefit => {
  $('#benefitList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + benefit + '</li>');
})

</script>
