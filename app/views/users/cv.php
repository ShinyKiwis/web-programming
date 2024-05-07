<div class="row my-4 px-5">
  <div class="col-12 p-4 h-100" id="profile">
    <div class="row" id="profile-header">
      <div class="col-2  d-flex justify-content-center">
        <img 
          src="https://images.unsplash.com/photo-1634896941598-b6b500a502a7?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
          alt="profile avatar"
          style="border-radius: 9999px;"
        />
      </div>
      <div class="col-10">
        <p class="fs-4 fw-medium"><?php echo $user['username']?></p>
        <div class="row">
          <div class="col-4">
            <p><i class="fa-solid fa-suitcase"></i>
              <?php if($user['cv']['current_position']) {
                echo $user['cv']['current_position'];
              } else {
                echo '<span class="prompt">Unavailable</span>';
              }?>
            </p>
            <p><i class="fa-solid fa-envelope"></i><span><?php echo $user['email'] ?></span></p>
            <p><i class="fa-solid fa-house"></i><span class="prompt" id="user_address">Edit to add your address</span></p>
          </div>
          <div class="col-4">
            <p><i class="fa-solid fa-user-graduate"></i>
              <?php if($user['cv']['highest_degree']) {
                echo $user['cv']['highest_degree'];
              } else {
                echo '<span class="prompt">Unavailable</span>';
              }?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section mt-2" id="desired-job">
      <p>Desired Job</p>
      <div class="row">
        <p class="col-2">Location</p>
        <p class="col-2 prompt" id="desired_job_location">Unavailable</p>
      </div>
      <div class="row">
        <p class="col-2">Expected Salary</p>
        <p class="col-2">              
          <?php if($user['cv']['desired_job_salary']) {
            echo $user['cv']['desired_job_salary'];
          } else {
            echo '<span class="prompt">Unavailable</span>';
          }?>
        </p>
      </div>
      <div class="row">
        <p class="col-2">Willing to relocation</p>
        <p class="col-2">
        <?php 
          if($user['cv']['willing_to_relocation'] !== null) {
          echo $user['cv']['willing_to_relocation'] == 0 ? "No" : "Yes";
        } else {
          echo '<span class="prompt">Unavailable</span>';
        }?>
        </p>
      </div>
    </div> 
    <div class="profile-section" id="career-goals">
      <p>Career Goals</p>
      <p>
        <?php if($user['cv']['career_goal']) {
          echo $user['cv']['career_goal'];
        } else {
          echo '<span class="prompt">Unavailable</span>';
        }?>
      </p>
    </div> 
    <div class="profile-section" id="experiences">
      <p>Experiences</p>
      <p>
        <?php if($user['cv']['experiences']) {
          echo $user['cv']['experiences'];
        } else {
          echo '<span class="prompt">Unavailable</span>';
        }?>
      </p>
    </div> 
    <div class="profile-section" id="education">
      <p>Education</p>
      <p>
        <?php if($user['cv']['education']) {
          echo $user['cv']['education'];
        } else {
          echo '<span class="prompt">Unavailable</span>';
        }?>
      </p>
    </div> 
    <div class="profile-section" id="skills">
      <p>Skills</p>
      <ul id="skillList">
      </ul>
      <p class="prompt">Unavailable</p>
    </div> 
    <div class="profile-section" id="languages">
      <p>Languages</p>
      <ul id="languageList">
      </ul>
      <p class="prompt">Unavailable</p>
    </div> 
  </div>
</div>
<script>
const selectedAddress = `<?php echo $user['address']['address']; ?>`;
const selectedCity = `<?php echo $user['address']['city']; ?>`;
const selectedDistrict = `<?php echo $user['address']['district']; ?>`;
const selectedWard = `<?php echo $user['address']['ward']; ?>`;
const desiredLocation = `<?php echo $user['cv']['desired_job_location']; ?>`;


// Handle skills and languages
const skills = `<?php echo $user['cv']['skills']; ?>`;
const languages = `<?php echo $user['cv']['languages']; ?>`;
if(skills.split("@").length > 0) {
  $("#skills .prompt").remove();
}

if(languages.split("@").length > 0) {
  $("#languages .prompt").remove();
}

skills.split("@").forEach(skill => {
  $('#skillList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + skill + '</li>');
})

languages.split("@").forEach(language => {
  $('#languageList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + language + '</li>');
})


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
