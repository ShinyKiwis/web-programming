<div class="mx-5 shadow-lg rounded px-2 py-4 mt-2 mb-5">
  <form class="d-flex gap-2" id="push-form" action="" method="GET">
    <div class="input-group flex-nowrap w-50">
      <span class="input-group-text" id="addon-wrapping">
        <i class="fa-solid fa-magnifying-glass"></i>
      </span>
      <input type="text" name="current_position" class="form-control" placeholder="Search positions..." aria-label="seach-query" aria-describedby="addon-wrapping">
    </div>
    <div >
    <input type="text"class="form-control" placeholder="Salary Expected" name="desired_job_salary">
    </div>
    <select class="selectpicker" name="desired_job_location" title="Location" id="city-picker" data-live-search="true" data-allow-clear="true">
    </select>
    <select class="selectpicker" name="willing_to_relocation" title="Willing to Relocation" data-allow-clear="true">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>
    <button id="search_btn" type="submit" class="btn btn-primary ms-auto">Search</button>
  </form>
</div>
<script>
$(document).ready(function () {
  $('select').selectpicker();
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
