<?php
session_start();
if(isset($_SESSION['user_id'])) {
  header("Location: http://localhost:8080/home");
  exit();
}
?>
<div class="row">
  <div class="col px-4 py-2 d-none d-lg-block" style="height: 100vh">
    <img 
      src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
      class="img-fluid rounded"
      style="object-fit: cover; width: 100%; height: 100%;"
    />
  </div>
  <div class="col d-flex flex-column justify-content-center align-items-center">
    <span class="blue-logo">
      Work Seekers
    </span>
    <p id="login-error" class="text-danger"></p>
    <form id="login-form" style="width:25em;">
      <input type="hidden" name="action" value="login">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="john@doe.com" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Your secret password" required>
      </div>
      <div style="text-align: end;" class="my-2 mb-4">
        <a href="#" class="gray-link">Forgot your password ?</a>
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
      <div class="my-2">
        Are you new ? <a href="/register" class="blue-link">Create an account</a>
      </div>
    </form>
  </div>
</div>
<script>
$("#login-form").on("submit", function(event) {
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: "post_index.php",
    data: $(this).serialize(),
    dataType: "json",
    success: function(response) {
      if (response.status == "error") {
        $("#login-error").text(response.message);
      } else {
        window.location.href = "http://localhost:8080/home"
      }
    }
  })
})
</script>
