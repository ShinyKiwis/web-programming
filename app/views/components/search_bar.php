<div class="mx-5 shadow-lg rounded px-2 py-4 mt-2">
  <form class="d-flex gap-2">
    <div class="input-group flex-nowrap w-50">
      <span class="input-group-text" id="addon-wrapping">
        <i class="fa-solid fa-magnifying-glass"></i>
      </span>
      <input type="text" class="form-control" placeholder="Search jobs..." aria-label="seach-query" aria-describedby="addon-wrapping">
    </div>
    <select class="selectpicker" name="location" title="Location" id="city-picker" data-live-search="true" data-allow-clear="true">
    </select>
    <select class="selectpicker" name="work_arrangement" title="Work arrangements" data-allow-clear="true">
      <option value="onsite">On site</option>
      <option value="remote">Remote</option>
      <option value="hybrid">Hybrid</option>
    </select>
    <select class="selectpicker" name="level" title="Levels" data-allow-clear="true">
      <option value="intern">Intern/Student</option>
      <option value="fresher">Fresher/Entry level</option>
      <option value="experienced">Experienced (non-manager)</option>
      <option value="manager">Manager</option>
      <option value="director">Director and above</option>
    </select>
    <button type="submit" class="btn btn-primary ms-auto">Search</button>
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
