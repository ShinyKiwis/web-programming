<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_SESSION['user'])) {
  header("Location: " . "http://localhost:8080/home");
}
?>
<div class="row mt-4 px-5">
  <div class="col-2 d-flex flex-column gap-4" id="profile-actions">
    <button><a href="/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button><a href="/profile"><i class="fa-solid fa-user"></i><span>My profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>My applied jobs</span></a></button>
    <button id="active"><a href="/profile/cv"><i class="fa-solid fa-file"></i><span>My CV</span></a></button>
  </div>
  <div class="col-10 p-4 h-100 mb-4" id="profile">
    <div class="row" id="profile-header">
      <div class="col-2  d-flex justify-content-center">
        <img 
          src="https://images.unsplash.com/photo-1634896941598-b6b500a502a7?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
          alt="profile avatar"
          style="border-radius: 9999px;"
        />
      </div>
      <div class="col-10">
        <p class="fs-4 fw-medium"><?php echo $_SESSION['user']['username']?></p>
        <div class="row">
          <div class="col-4">
            <p><i class="fa-solid fa-suitcase"></i>
              <?php if($_SESSION['user']['cv']['current_position']) {
                echo $_SESSION['user']['cv']['current_position'];
              } else {
                echo '<span class="prompt">Edit to add your current position</span>';
              }?>
            </p>
            <p><i class="fa-solid fa-envelope"></i><span><?php echo $_SESSION['user']['email'] ?></span></p>
            <p><i class="fa-solid fa-house"></i><span class="prompt" id="user_address">Edit to add your address</span></p>
          </div>
          <div class="col-4">
            <p><i class="fa-solid fa-user-graduate"></i>
              <?php if($_SESSION['user']['cv']['highest_degree']) {
                echo $_SESSION['user']['cv']['highest_degree'];
              } else {
                echo '<span class="prompt">Edit to add your highest degree</span>';
              }?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section mt-2" id="profile-cv">
      <p>Your CV</p>
      <p id="upload-result" class="text-success"></p>
      <form id="upload-cv-form">
        <input type="hidden" name="action" value="upload_cv">
        <input type="file" name="cv" id="upload-cv" style="display:none">
        <input type="hidden" name="user_id" id="user_id" value=<?php echo $_SESSION['user_id'] ?>>
        <button type="submit" class="btn btn-primary ms-auto">Upload CV</button>
      </form>
      <div id="cv-viewer" class="mt-4" style="height: 40em;"></div>
    </div> 
  </div>
</div>
<script>
$("#upload-cv-form").on("submit", function(event) {
  event.preventDefault();
  $("#upload-cv").click();
})

$("#upload-cv").on("change", function() {
  const uploadedFiles = $("#upload-cv")[0];
  if(uploadedFiles.files.length > 0) {
    const formData = new FormData($("#upload-cv-form")[0]);
    $.ajax({
      type: "POST",
      url: "/post_index.php",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(response) {
        $("#upload-result").text(response.message);
        render_cv();
      }
    }) 
  }
});

function render_cv() {
  const user_id = "<?php echo $_SESSION['user']['id']; ?>";
  $.ajax({
    type: "POST",
    url: "/post_index.php",
    data: {"user_id": user_id, "action": "get_cv"},
    success: function(response) {
      const data = JSON.parse(response);
      if(data.status === "success") {
        PDFObject.embed("data:application/pdf;base64," + data.cv, "#cv-viewer");
      }
    }
  })
}

render_cv();
const selectedAddress = `<?php echo $_SESSION['user']['address']['address']; ?>`;
const selectedCity = `<?php echo $_SESSION['user']['address']['city']; ?>`;
const selectedDistrict = `<?php echo $_SESSION['user']['address']['district']; ?>`;
const selectedWard = `<?php echo $_SESSION['user']['address']['ward']; ?>`;
const desiredLocation = `<?php echo $_SESSION['user']['cv']['desired_job_location']; ?>`;

$.ajax({
  url: "http://localhost:8080/data/address.json",
  method: "GET",
  dataType: "json",
  success: function(data) {
    const cities = Object.values(data);
    let address = "";
    let selectedCityValue = "";
    let selectedDistrictValue = "";
    let selectedWardValue = "";
    cities.forEach(city => {
      if(city.slug == selectedCity) {
        selectedCityValue = city.name_with_type;
        city.quan_huyen.forEach(district => {
          if(district.slug == selectedDistrict) {
            selectedDistrictValue = district.name_with_type;
            district.xa_phuong.forEach(ward => {
              if(ward.slug == selectedWard) {
                selectedWardValue = ward.name_with_type;
              }
            })
          }
        })
      }
    })
    if(selectedWardValue && selectedCityValue && selectedDistrictValue) {
      $("#user_address").removeClass("prompt");
      $("#user_address").text([selectedAddress, selectedWardValue, selectedDistrictValue, selectedCityValue].join(", "))
    }

    cities.forEach(city => {
      if(city.slug == desiredLocation) {
        $("#desired_job_location").removeClass("prompt");
        $("#desired_job_location").text(city.name_with_type);
      }
    })
  }
})

</script>
