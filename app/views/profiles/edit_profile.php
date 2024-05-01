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
    <button id="active"><a href="/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button><a href="/profile"><i class="fa-solid fa-user"></i><span>My profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>My applied jobs</span></a></button>
    <button><a><i class="fa-solid fa-file"></i><span>My CV</span></a></button>
  </div>
    <div class="col-10 p-4" id="profile">
    <form id="update-form" action="/post_index.php" method="POST">
      <input type="hidden" name="user_id" id="user_id" value=<?php echo $_SESSION['user_id'] ?>>
      <input type="hidden" name="action" value="update_user">
      <div class="row" id="profile-header">
        <div class="col-2  d-flex justify-content-center">
          <a id="uploadLink" href="#">
            <img id="avatarImg" 
                src="https://images.unsplash.com/photo-1634896941598-b6b500a502a7?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                alt="profile avatar"
                style="border-radius: 9999px; width: 200px; height: 200px;"
            />
          </a>
          <input type="file" id="uploadImage" style="display:none" accept="image/*">
        </div>
        <div class="col-10">
          <p class="fs-4 fw-medium"><?php echo $_SESSION['user']['username'] ?></p>
          <div class="row">
            <div class="col-3">
              <p><i class="fa-solid fa-suitcase"></i><input type="text" class="form-control" name="current_position" value="<?php echo $_SESSION['user']['cv']['current_position'] ?>" 
                placeholder="Your current position" required /></p>
              <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
            </div>
            <div class="col-4">
              <p><i class="fa-solid fa-user-graduate"></i>          
              <select class="col-2 selectpicker" name="highest_degree" title="Your highest degree" data-allow-clear="true">
                <option value="High School" <?php echo $_SESSION['user']['cv']['highest_degree'] == 'High School' ? 'selected' : '' ?>>High school</option>
                <option value="College" <?php echo $_SESSION['user']['cv']['highest_degree'] == 'College' ? 'selected' : '' ?>>College</option>
                <option value="Bachelors" <?php echo $_SESSION['user']['cv']['highest_degree'] == 'Bachelors' ? 'selected' : '' ?>>Bachelors</option>
                <option value="Masters" <?php echo $_SESSION['user']['cv']['highest_degree'] == 'Masters' ? 'selected' : '' ?>>Masters</option>
                <option value="Doctorate" <?php echo $_SESSION['user']['cv']['highest_degree'] == 'Doctorate' ? 'selected' : '' ?>>Doctorate</option>
                <option value="Higher" <?php echo $_SESSION['user']['cv']['highest_degree'] == 'Higher' ? 'selected' : '' ?>>Higher</option>
              </select>            
            </div>
            <div class="row d-flex align-items-center">
              <p class="col-3 mb-0"><i class="fa-solid fa-house"></i>
                <input type="text" class="form-control" value="<?php echo $_SESSION['user']['address']['address'] ?>" name="address_address" placeholder="Your address" required />
              </p>
              <select class="selectpicker" name="address_city" title="City" data-allow-clear id="city-picker" data-live-search="true" data-width="fit" required></select>
              <select class="selectpicker" name="address_district" title="District" data-allow-clear id="district-picker" data-live-search="true" data-width="fit" disabled required></select>
              <select class="selectpicker" name="address_ward" title="Ward" data-allow-clear id="ward-picker" data-live-search="true" data-width="fit" disabled required></select>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-section mt-2" id="desired-job">
        <p>Desired Job</p>
        <div class="row">
          <p class="col-2">Location</p>
          <p class="col-2">
            <select class="selectpicker" name="desired_job_location" title="Location" data-allow-clear id="location-picker" data-live-search="true" data-width="fit" required></select>
          </p>
        </div>
        <div class="row">
          <p class="col-2">Expected Salary</p>
          <div class="col-2"><input type="text" class="form-control" value="<?php echo $_SESSION['user']['cv']['desired_job_salary'] ?>" name="desired_job_salary" placeholder="Your expected salary" required /></div>
        </div>
        <div class="row">
          <p class="col-2">Willing to relocation</p>
          <select class="col-2 selectpicker" name="willing_to_relocation" title="Relocation ?" data-allow-clear="true" required />
            <option value="true" <?php echo $_SESSION['user']['cv']['willing_to_relocation'] == "1" ? 'selected' : '' ?>>Yes</option>
            <option value="false" <?php echo $_SESSION['user']['cv']['willing_to_relocation'] == "0" ? 'selected' : '' ?>>No</option>
          </select>
        </div>
      </div> 
      <div class="profile-section" id="career-goals">
        <p>Career Goals</p>
        <textarea type="text" class="form-control" name="career_goal" placeholder="Your career goals" style="height: 100px" required><?php echo $_SESSION['user']['cv']['career_goal'] ?></textarea>
      </div> 
      <div class="profile-section" id="experiences">
        <p>Experiences</p>
        <textarea type="text" class="form-control" name="experiences" placeholder="Your experiences" style="height: 100px" required><?php echo $_SESSION['user']['cv']['experiences'] ?></textarea>    
      </div> 
      <div class="profile-section" id="education">
        <p>Education</p>
        <textarea type="text" class="form-control" name="education" placeholder="Your education" style="height: 100px" required><?php echo $_SESSION['user']['cv']['education'] ?></textarea>
      </div> 
      <div class="profile-section" id="skills">
        <p>Skills</p>
        <div class="d-flex align-items-center">
          <input type="text" class="form-control" style="width: 25%; margin-bottom: 0px;"  id="skillInput" placeholder="Enter a skill"/>
          <button id="addSkillIcon" class="btn btn-primary ms-2">Add skill</button>
        </div>
        <ul id="skillList">
        </ul>
      </div> 
      <div class="profile-section" id="languages">
        <p>Languages</p>
        <div class="d-flex align-items-center">
          <input type="text" class="form-control" style="width: 25%; margin-bottom: 0px;" id="languageInput" placeholder="Enter a language">
          <button id="addLanguageIcon" class="btn btn-primary ms-2">Add language</button>
        </div>
        <ul id="languageList">
        </ul>
      </div> 
      <button type="submit" id="submit" class="btn btn-primary mt-2 float-end">Update</button>
    </form>
    </div>
</div>
<script>
// Populate skills and languages
const skills = `<?php echo $_SESSION['user']['cv']['skills']; ?>`;
const languages = `<?php echo $_SESSION['user']['cv']['languages']; ?>`;

skills.split("@").forEach(skill => {
  $('#skillList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + skill + ' <button class="deleteSkillBtn btn btn-danger ms-auto">Delete</button></li>');
})

languages.split("@").forEach(language => {
  $('#languageList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + language + ' <button class="deleteLanguageBtn btn btn-danger ms-auto">Delete</button></li>');
})

$(document).ready(function() {
    $('#addSkillIcon').click(function(event) {
        event.preventDefault();
        var skill = $('#skillInput').val().trim();
        if (skill !== '') {
            $('#skillList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + skill + ' <button class="deleteSkillBtn btn btn-danger ms-auto">Delete</button></li>');
            $('#skillInput').val('');
        }
    });
    $(document).on('click', '.deleteSkillBtn', function() {
        $(this).parent().remove();
    });
    $('#update-form').submit(function(event) {
        var skills = [];
        $('#skillList li').each(function() {
            var skill = $(this).text().trim().split(' ')[0];
            skills.push(skill);
        });
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            name: 'skills',
            value: skills.join('@')
        });
        $(this).append(hiddenInput);
    });
});
$(document).ready(function() {
    $('#addLanguageIcon').click(function(event) {
        event.preventDefault();
        var language = $('#languageInput').val().trim();
        if (language !== '') {
            $('#languageList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + language + ' <button class="deleteLanguageBtn btn btn-danger ms-auto">Delete</button></li>');
            $('#languageInput').val('');
        }
    });
    $(document).on('click', '.deleteLanguageBtn', function() {
        $(this).parent().remove();
    });
    $('#update-form').submit(function(event) {
        var languages = [];
        $('#languageList li').each(function() {
            var language = $(this).text().trim().split(' ')[0];
            languages.push(language);
        });
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            name: 'languages',
            value: languages.join('@')
        });
        $(this).append(hiddenInput);
    });
});
$(document).ready(function(){
  $('#uploadImage').change(function(){
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.onload = function() {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            var maxWidth = 150;
            var maxHeight = 150;
            var width = img.width;
            var height = img.height;

            if (width > height) {
                if (width > maxWidth) {
                    height *= maxWidth / width;
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width *= maxHeight / height;
                    height = maxHeight;
                }
            }

            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0, width, height);

            var newDataUrl = canvas.toDataURL('image/jpeg');
            $('#avatarImg').attr('src', newDataUrl);
        };
  };
  reader.readAsDataURL(file);
});

$('#uploadLink').click(function(e){
    e.preventDefault();
    $('#uploadImage').click();
});
});
let cities = []
const selectedCity = `<?php echo $_SESSION['user']['address']['city']; ?>`;
const selectedDistrict = `<?php echo $_SESSION['user']['address']['district']; ?>`;
const selectedWard = `<?php echo $_SESSION['user']['address']['ward']; ?>`;
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8080/data/address.json",
    method: "GET",
    dataType: "json",
    success: function(data) {
      cities = Object.values(data);
      const citiesOptions = cities.map(city => ({
        value: city.slug,
        option: city.name_with_type
      }))
      $.each(citiesOptions, function(_, item) {
        $("#location-picker").append($('<option>', {
          value: item.value,
          text: item.option,
          selected: item.value === selectedCity
        }))
        $("#city-picker").append($('<option>', {
          value: item.value,
          text: item.option,
          selected: item.value === selectedCity
        }))
      }) 
      $('#city-picker').selectpicker('refresh');
      $('#location-picker').selectpicker('refresh');
      if(selectedDistrict) {
        populateDistrict(selectedCity);
        if(selectedWard) {
          populateWard(selectedDistrict)
        }
      }
    }
  })
})

$("#city-picker").on("change", function() {
  const selectedCity = cities.filter(city => city.slug == $(this).val())[0];
  // Clear options value
  $("#district-picker").find('option').remove();
  $("#district-picker").selectpicker("destroy");
  $("#district-picker").selectpicker();

  $("#ward-picker").find('option').remove();
  $("#ward-picker").selectpicker("destroy");
  $("#ward-picker").selectpicker();

  // Set new data
  $("#district-picker").prop("disabled", false);
  const districtsOptions = selectedCity.quan_huyen.map(district => ({
    value: district.slug,
    option: district.name_with_type
  }))
  $.each(districtsOptions, function(_, item) {
    $("#district-picker").append($('<option>', {
      value: item.value,
      text: item.option
    }))
  }) 
  $("#district-picker").selectpicker("refresh");
})

$("#district-picker").on("change", function() {
  const selectedDistrict = cities.
    filter(city => city.slug == $("#city-picker").val())[0].quan_huyen.
    filter(district => district.slug == $(this).val())[0];
  // Clear options value
  $("#ward-picker").find('option').remove();
  $("#ward-picker").selectpicker("destroy");
  $("#ward-picker").selectpicker();

  // Set new data
  $("#ward-picker").prop("disabled", false);
  console.log(selectedDistrict)
  const wardsOptions = selectedDistrict.xa_phuong.map(ward => ({
    value: ward.slug,
    option: ward.name_with_type
  }))
  $.each(wardsOptions, function(_, item) {
    $("#ward-picker").append($('<option>', {
      value: item.value,
      text: item.option
    }))
  }) 
  $("#ward-picker").selectpicker("refresh");
})

function populateDistrict(selectedCity) {
 const selectedCityValue = cities.filter(city => city.slug == selectedCity)[0];
  // Clear options value
  $("#district-picker").find('option').remove();
  $("#district-picker").selectpicker("destroy");
  $("#district-picker").selectpicker();

  $("#ward-picker").find('option').remove();
  $("#ward-picker").selectpicker("destroy");
  $("#ward-picker").selectpicker();

  // Set new data
  $("#district-picker").prop("disabled", false);
  const districtsOptions = selectedCityValue.quan_huyen.map(district => ({
    value: district.slug,
    option: district.name_with_type
  }))
  $.each(districtsOptions, function(_, item) {
    $("#district-picker").append($('<option>', {
      value: item.value,
      text: item.option,
      selected: item.value == selectedDistrict
    }))
  }) 
  $("#district-picker").selectpicker("refresh");
}

function populateWard(selectedDistrict) {
  const selectedDistrictValue = cities
    .filter(city => city.slug == $("#city-picker").val())[0].quan_huyen
    .filter(district => district.slug == selectedDistrict)[0];

  // Clear options value
  $("#ward-picker").find('option').remove();
  $("#ward-picker").selectpicker("destroy");
  $("#ward-picker").selectpicker();

  // Set new data
  $("#ward-picker").prop("disabled", false);
  const wardsOptions = selectedDistrictValue.xa_phuong.map(ward => ({
    value: ward.slug,
    option: ward.name_with_type
  }));
  $.each(wardsOptions, function(_, item) {
    $("#ward-picker").append($('<option>', {
      value: item.value,
      text: item.option,
      selected: item.value == selectedWard
    }));
  }); 
  $("#ward-picker").selectpicker("refresh");
}

</script>
