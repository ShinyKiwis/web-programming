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
    <form action="post_index.php" method="POST" style="width: 25em;">
      <input type="hidden" name="action" value="create_user">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="John Doe" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="john@doe.com" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Your secret password" required>
      </div>
      <p id="password-error" class="text-danger"></p>
      <div class="mb-3">
        <label>Who are you ?</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="userType" id="candidate" value="candidate" checked>
          <label class="form-check-label" for="candidate">
            <span>Candidate</span> - Who are looking for jobs
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="userType" id="employer" value="employer">
          <label class="form-check-label" for="employer">
            <span>Employer</span> - Who are looking for someone to hire
          </label>
        </div>
      </div>
      <button type="submit" id="submit" class="btn btn-primary mt-2" style="width: 100%">Register</button>
      <div class="my-2">
        Already have an account ? <a href="/login" class="blue-link">Login</a>
      </div>
    </form>
  </div>
</div>
<script>
$("#password").on("input", function() {
  const password = $(this).val();
  const pattern = /^(?=.*\d)(?=.*[A-Z]).{8,}$/;
  const passwordError = $("#password-error");
  const submitButton = $("#submit");
  if (pattern.test(password) || password == "") {
    passwordError.text("");
    submitButton.prop("disabled", false);
  } else {
    passwordError.text("Password must be at least 8 characters long and contain at least one digit and one uppercase letter.");
    submitButton.prop("disabled", true);
  }
}) 
</script>
