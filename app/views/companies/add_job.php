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
    <button><a href="/company/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button ><a href="/company/profile"><i class="fa-solid fa-user"></i><span>Companies profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>Listed jobs</span></a></button>
    <button id="active"><a href="/company/add-job"><i class="fa-solid fa-file"></i><span>Add new job</span></a></button>
  </div>
  <div class="col-10 p-4 h-100" id="profile">
  <form id="update-form" action="/post_index.php" method="POST">
    <input type="hidden" name="user_id" id="user_id" value=<?php echo $_SESSION['user_id'] ?>>
    <input type="hidden" name="action" value="create_job" />
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
        <p class="fs-4 fw-medium"><input type="text" class="form-control" name="job" placeholder="Job title" style="height: 100px, width: 300px;" required /></p>
        <div class="row">
          <div class="col-4">
            <p><i class="fa-solid fa-calendar"></i><input type="date" class="form-control" name="enddate_hiring" value="" placeholder="Hiring end date" required /></p>
            <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
            <div class="d-flex gap-4">
              <p>
                <i class="fa-solid fa-location-dot"></i>
                <select class="selectpicker" name="address_city" title="City" data-allow-clear id="city-picker" data-live-search="true" data-width="fit" required>
                </select>
              </p>
              <select class="selectpicker" name="work_arrangement" title="Work arrangements" data-allow-clear="true" required>
                <option value="onsite">On site</option>
                <option value="remote">Remote</option>
                <option value="hybrid">Hybrid</option>
              </select>
              <select class="selectpicker" name="level" title="Levels" data-allow-clear="true" required>
                <option value="intern">Intern/Student</option>
                <option value="fresher">Fresher/Entry level</option>
                <option value="experienced">Experienced (non-manager)</option>
                <option value="manager">Manager</option>
                <option value="director">Director and above</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section mt-4" id="description">
      <p>Description</p>
      <textarea type="text" class="form-control" name="description" placeholder="Job description" style="height: 100px" required></textarea>
    </div> 
    <div class="profile-section" id="requirements">
      <p>Requirements</p>
      <div class="d-flex align-items-center">
          <input type="text" class="form-control" style="width: 25%; margin-bottom: 0px;"  id="requireInput" placeholder="Enter a requirement">
          <button id="addRequireIcon" class="btn btn-primary ms-2">Add requirements</button>
        </div>
        <ul id="requireList">
        </ul>
    </div>
    <div class="profile-section" id="salary">
      <p>Salary</p>
      <label>
        <input type="radio" name="option" value="Salary Negotiation"> Negotiate
      </label><br>
      <label>
        <input type="radio" name="option"  id="add-salary"> Add Salary
      </label><br>
      <div div div id="additionalInput" style="display:none;">
        <input type="text" class="form-control mt-2" id="additionalOption" name="salary" placeholder="Enter salary" style="width: 200px;" >
      </div>
    </div> 
    <div class="profile-section mt-2" id="benefit">
      <p>Benefit</p>
      <div class="d-flex align-items-center">
          <input type="text" class="form-control" style="width: 25%; margin-bottom: 0px;"  id="benefitInput" placeholder="Enter a benefit">
          <button id="addBenefitIcon" class="btn btn-primary ms-2">Add benefit</button>
        </div>
        <ul id="benefitList">
        </ul>
    </div>
    <button type="submit" id="submit_btn" class="btn btn-primary mt-2 float-end">Create</button>
</form>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#addRequireIcon').click(function(event) {
        event.preventDefault();
        var require = $('#requireInput').val().trim();
        if (require !== '') {
            $('#requireList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + require + ' <button class="deleteRequireBtn btn btn-danger ms-auto">Delete</button></li>');
            $('#requireInput').val('');
        }
    });
    $(document).on('click', '.deleteRequireBtn', function() {
        $(this).parent().remove();
    });
});
$(document).ready(function() {
    $('#addBenefitIcon').click(function(event) {
        event.preventDefault();
        var benefit = $('#benefitInput').val().trim();
        if (benefit !== '') {
            $('#benefitList').append('<li class="d-flex align-items-center mt-2" style="width: 15em;">' + benefit + ' <button class="deleteBenefitBtn btn btn-danger ms-auto">Delete</button></li>');
            $('#benefitInput').val('');
        }
    });
    $(document).on('click', '.deleteBenefitBtn', function() {
        $(this).parent().remove();
    });
});

$(document).ready(function() {
        $('#update-form').submit(function(event) {
            event.preventDefault();

            var benefits = [];
            $('#benefitList li').each(function() {
                var benefit = $(this).text().trim().split(' ')[0];
                benefits.push(benefit);
            });
            var hiddenInput = $('<input>').attr({
                type: 'hidden',
                name: 'benefits',
                value: benefits.join('@')
            });
            $(this).append(hiddenInput);

            var requires = [];
            $('#requireList li').each(function() {
                var require = $(this).text().trim().split(' ')[0];
                requires.push(require);
            });
            var hiddenInput = $('<input>').attr({
                type: 'hidden',
                name: 'requires',
                value: requires.join('@')
            });
            $(this).append(hiddenInput);

            var selectedOption = $('input[type=radio][name=option]:checked').val();
            if (selectedOption === 'option2') {
                var additionalValue = $('#additionalOption').val().trim();

                $(this).append('<input type="hidden" name="option2Value" value="' + additionalValue + '">');
            }
            this.submit();
        });
        $('#add-salary').click(function() {
            $('#additionalInput').show();
        });
        $('input[type=radio][value=option1]').click(function() {
            $('#additionalInput').hide();
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
        $("#city-picker").append($('<option>', {
          value: item.value,
          text: item.option
        }))
      }) 
      $('#city-picker').selectpicker('refresh');
    }
  })
});
</script>
