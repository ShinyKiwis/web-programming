<div class="row mt-4 px-5">
  <div class="col-2 d-flex flex-column gap-4" id="profile-actions">
    <button id="active"><a href="/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button><a href="/profile"><i class="fa-solid fa-user"></i><span>My profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>My applied jobs</span></a></button>
    <button><a><i class="fa-solid fa-file"></i><span>My CV</span></a></button>
  </div>
  <div class="col-10 p-4" id="profile">
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
        <p class="fs-4 fw-medium">John Doe</p>
        <div class="row">
          <div class="col-3">
          <p><i class="fa-solid fa-suitcase"></i><input type="text" class="form-control" value="Junior Backend Engineer"></p>
            <p><i class="fa-solid fa-envelope"></i><input type="text" class="form-control" value="johndoe@gmail.com"></p>
            <p><i class="fa-solid fa-house"></i><input type="text" class="form-control" placeholder="Edit to add your address"></p>
          </div>
          <div class="col-4">
            <p><i class="fa-solid fa-user-graduate"></i><input type="text" class="form-control" placeholder="Edit to add your highest degree"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section mt-2" id="desired-job">
      <p>Desired Job</p>
      <div class="row">
        <p class="col-2">Location</p>
        <p class="col-2"><input type="text" class="form-control" placeholder="Edit Location"></p>
      </div>
      <div class="row">
        <p class="col-2">Expected Salary</p>
        <div class="col-2"><input type="text" class="form-control" placeholder="Edit Expected Salary"></div>
      </div>
    </div> 
    <div class="profile-section" id="career-goals">
      <p>Career Goals</p>
      <div><input type="text" class="form-control" placeholder="Edit your Career Goals"></div>
    </div> 
    <div class="profile-section" id="experiences">
      <p>Experiences</p>
      <input type="text" class="form-control" placeholder="Edit your experiences">    
    </div> 
    <div class="profile-section" id="education">
      <p>Education</p>
      <input type="text" class="form-control" placeholder="Edit your education">
    </div> 
    <div class="profile-section" id="skills">
      <p>Skills</p>
      <div>
        <i id="addSkillIcon" class="fas fa-plus"></i>
        <input type="text" id="skillInput" placeholder="Enter a skill">
      </div>
      <ul id="skillList">
      </ul>
    </div> 
    <div class="profile-section" id="languages">
      <p>Languages</p>
      <div>
        <i id="addLanguageIcon" class="fas fa-plus"></i>
        <input type="text" id="languageInput" placeholder="Enter a language">
      </div>
      <ul id="languageList">
      </ul>
    </div> 
  </div>
</div>
<script>
        $(document).ready(function(){
            $('#addSkillIcon').click(function(){
                var skill = $('#skillInput').val().trim();
                if(skill !== '') {
                    $('#skillList').append('<li>' + skill + ' <button class="deleteSkillBtn">Delete</button></li>');
                    $('#skillInput').val('');
                }
            });

            $(document).on('click', '.deleteSkillBtn', function(){
                $(this).parent().remove();
            });
        });
        $(document).ready(function(){
            $('#addLanguageIcon').click(function(){
                var language = $('#languageInput').val().trim();
                if(language !== '') {
                    $('#languageList').append('<li>' + language + ' <button class="deleteLanguageBtn">Delete</button></li>');
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
                e.preventDefault(); // Prevent default behavior of anchor tag
                $('#uploadImage').click(); // Trigger the file input click event
            });
        });
</script>