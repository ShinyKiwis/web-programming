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
          <p class="fs-4 fw-medium"><input type="text" class="form-control" value="<?php echo $_SESSION['user']['username'] ?>" placeholder="Your username"></p>
          <div class="row">
            <div class="col-3">
              <p><i class="fa-solid fa-suitcase"></i><input type="text" class="form-control" name="current_position" value="" placeholder="Your current position"></p>
              <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
              <p><i class="fa-solid fa-house"></i><input type="text" class="form-control" placeholder="Edit to add your address"></p>
            </div>
            <div class="col-4">
              <p><i class="fa-solid fa-user-graduate"></i><input type="text" class="form-control" name="highest_degree" placeholder="Edit to add your highest degree"></p>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-section mt-2" id="desired-job">
        <p>Desired Job</p>
        <div class="row">
          <p class="col-2">Location</p>
          <p class="col-2"><input type="text" class="form-control" name="desired_job_location" placeholder="Your location"></p>
        </div>
        <div class="row">
          <p class="col-2">Expected Salary</p>
          <div class="col-2"><input type="text" class="form-control" name="desired_job_salary"  placeholder="Your expected salary"></div>
        </div>
      </div> 
      <div class="profile-section" id="career-goals">
        <p>Career Goals</p>
        <textarea type="text" class="form-control" name="career_goal" placeholder="Your career goals" style="height: 100px"></textarea>
      </div> 
      <div class="profile-section" id="experiences">
        <p>Experiences</p>
        <textarea type="text" class="form-control" name="experiences" placeholder="Your experiences" style="height: 100px"></textarea>    
      </div> 
      <div class="profile-section" id="education">
        <p>Education</p>
        <textarea type="text" class="form-control" name="education" placeholder="Your education" style="height: 100px"></textarea>
      </div> 
      <div class="profile-section" id="skills">
        <p>Skills</p>
        <div>
          <input type="text" id="skillInput" placeholder="Enter a skill">
          <button id="addSkillIcon" class="btn btn-primary ms-2">Add skill</button>
        </div>
        <ul id="skillList">
        </ul>
      </div> 
      <div class="profile-section" id="languages">
        <p>Languages</p>
        <div>
          <input type="text" id="languageInput" placeholder="Enter a language">
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
$('#addSkillIcon').click(function(event){
  event.preventDefault();
  var skill = $('#skillInput').val().trim();
  if(skill !== '') {
    $('#skillList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + skill + ' <button class="deleteSkillBtn btn btn-danger ms-auto">Delete</button></li>');
    $('#skillInput').val('');
  }
});

$(document).on('click', '.deleteSkillBtn', function(){
  $(this).parent().remove();
});

$(document).ready(function(){
  $('#addLanguageIcon').click(function(){
    var language = $('#languageInput').val().trim();
    if(language !== '') {
      $('#languageList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + language + ' <button class="deleteLanguageBtn btn btn-danger ms-auto">Delete</button></li>');
      $('#languageInput').val('');
    }
  });

  $(document).on('click', '.deleteLanguageBtn', function(){
      $(this).parent().remove();
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
</script>
