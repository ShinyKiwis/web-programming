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
    <button id="active"><a href="/companies/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
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
          <p class="fs-4 fw-medium"><input type="text" class="form-control" value="<?php echo $_SESSION['user']['username'] ?>" placeholder="Your username"></p>
          <div class="row">
            <div class="col-3">
              <p><i class="fa-solid fa-person"></i><input type="text" class="form-control" name="worker_number" value="" placeholder="Number of workers"></p>
              <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
            </div>
            <div class="row d-flex align-items-center">
              <p class="col-3 mb-0"><i class="fa-solid fa-house"></i><input type="text" class="form-control" placeholder="Your address" /></p>
              <select class="selectpicker" name="address_city" title="City" data-allow-clear id="city-picker" data-live-search="true" data-width="fit"></select>
              <select class="selectpicker" name="address_district" title="District" data-allow-clear id="district-picker" data-live-search="true" data-width="fit" disabled></select>
              <select class="selectpicker" name="address_ward" title="Ward" data-allow-clear id="ward-picker" data-live-search="true" data-width="fit" disabled></select>
            </div>
          </div>
        </div>
    </div>
    <div class="profile-section" id="description">
      <p>About Us</p>
      <textarea type="text" class="form-control" name="description" placeholder="Your company description" style="height: 100px"></textarea>
      <button type="submit" id="submit" class="btn btn-primary mt-2 float-end">Update</button>
    </form>
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
</script>