<div class="mx-5 shadow-lg rounded px-2 py-4 mt-2">
  <form class="d-flex gap-2">
    <div class="input-group flex-nowrap w-50">
      <span class="input-group-text" id="addon-wrapping">
        <i class="fa-solid fa-magnifying-glass"></i>
      </span>
      <input type="text" class="form-control" placeholder="Search jobs..." aria-label="seach-query" aria-describedby="addon-wrapping">
    </div>
    <select class="selectpicker" title="Location" data-live-search="true" data-allow-clear="true">
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <select class="selectpicker" title="Job type" data-live-search="true" data-allow-clear="true">
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <select class="selectpicker" title="Experiences" data-live-search="true" data-allow-clear="true">
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <button type="submit" class="btn btn-primary ms-auto">Search</button>
  </form>
</div>
<script>
$(document).ready(function () {
  $('select').selectpicker();
})
</script>
