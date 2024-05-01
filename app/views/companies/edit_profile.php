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
    <button id="active"><a href=""><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button ><a><i class="fa-solid fa-user"></i><span>Companies profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>Listed jobs</span></a></button>
    <button><a href="/profile/cv"><i class="fa-solid fa-file"></i><span>Add new job</span></a></button>
  </div>
  <div class="col-10 p-4 h-100" id="profile">
  <form id="update-form" action="/post_index.php" method="POST">
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
        <p class="fs-4 fw-medium"><?php echo $_SESSION['user']['username']?></p>
        <div class="row">
          <div class="col-4">
            <p><i class="fa-solid fa-calendar"></i><span>Add hiring end date</span></p>
            <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
            <p><i class="fa-solid fa-location-dot"></i><select class="selectpicker" name="address_city" title="City" data-allow-clear id="city-picker" data-live-search="true" data-width="fit"></select></p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section" id="description">
      <p>Description</p>
      <textarea type="text" class="form-control" name="description" placeholder="Company description" style="height: 100px"></textarea>
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
      <form>
      <label>
        <input type="radio" name="option" value="option1"> Negotiate
      </label><br>
      <label>
        <input type="radio" name="option" value="option2" id="option2"> Add Salary
      </label><br>
      <div div div id="additionalInput" style="display:none;">
        <input type="text" class="form-control mt-2" id="additionalOption" name="additionalOption" placeholder="Enter salary" style="width: 200px;" >
      </div>
      </form>
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
    <button type="submit" id="submit" class="btn btn-primary mt-2 float-end">Update</button>
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
    $('#update-form').submit(function(event) {
        var requires = [];
        $('#requireList li').each(function() {
            var require = $(this).text().trim().split(' ')[0];
            requires.push(Require);
        });
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            name: 'requires',
            value: requires.join('@')
        });
        $(this).append(hiddenInput);
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
    $('#update-form').submit(function(event) {
        var benefits = [];
        $('#benefitList li').each(function() {
            var benefit = $(this).text().trim().split(' ')[0];
            benefits.push(Benefit);
        });
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            name: 'benefits',
            value: benefits.join('@')
        });
        $(this).append(hiddenInput);
    });
});
$(document).ready(function() {
        $('#update-form').submit(function(event) {
            event.preventDefault();
            var selectedOption = $('input[type=radio][name=option]:checked').val();
            if (selectedOption === 'option2') {
                var additionalValue = $('#additionalOption').val().trim();
                $(this).append('<input type="hidden" name="option2Value" value="' + additionalValue + '">');
            }
            this.submit();
        });
        $('#option2').click(function() {
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
})
</script>