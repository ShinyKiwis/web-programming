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
    <button><a href="/company/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit company profile</span></a></button>
    <button id="active"><a><i class="fa-solid fa-user"></i><span>Company profile</span></a></button>
    <button><a href="/company/list-job"><i class="fa-solid fa-suitcase"></i><span>Listed jobs</span></a></button>
    <button><a href="/company/add-job"><i class="fa-solid fa-file"></i><span>Add new job</span></a></button>
  </div>
  <div class="col-10 p-4 h-100" id="profile">
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
            <p><i class="fa-solid fa-person"></i>
              <?php if($_SESSION['user']['company']['size']) {
                echo $_SESSION['user']['company']['size'];
              } else {
                echo '<span class="prompt">Edit to add your company size</span>';
              }?>
            </p>
            <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
            <p><i class="fa-solid fa-house"></i><span class="prompt" id="user_address">Edit to add your company address</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section" id="description">
      <p>About Us</p>
      <p>
        <?php if($_SESSION['user']['company']['description']) {
          echo $_SESSION['user']['company']['description'];
        } else {
          echo '<span class="prompt">Edit to add your company description</span>';
        }?>
      </p>
    </div> 
    <!-- <div class="profile-section" id="requirements">
      <p>Requirements</p>
      <p class="prompt">Add requirements</p>
    </div>
    <div class="profile-section" id="salary">
      <p>Salary</p>
      <p class="prompt">Add salary</p>
    </div> 
    <div class="profile-section" id="benefit">
      <p>Benefit</p>
      <p class="prompt">Add benefit</p>
    </div> 
  </div>
</div> -->
<script>
const selectedAddress = `<?php echo $_SESSION['user']['address']['address']; ?>`;
const selectedCity = `<?php echo $_SESSION['user']['address']['city']; ?>`;
const selectedDistrict = `<?php echo $_SESSION['user']['address']['district']; ?>`;
const selectedWard = `<?php echo $_SESSION['user']['address']['ward']; ?>`;

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
