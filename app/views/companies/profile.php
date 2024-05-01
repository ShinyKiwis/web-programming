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
    <button><a href="/companies/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button id="active"><a><i class="fa-solid fa-user"></i><span>Companies profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>Listed jobs</span></a></button>
    <button><a href="/profile/cv"><i class="fa-solid fa-file"></i><span>Add new job</span></a></button>
  </div>
  <div class="col-10 p-4 h-100" id="profile">
    <div class="row" id="profile-header">
      <div class="col-2  d-flex justify-content-center">
        <img 
          src="https://images.unsplash.com/photo-1634896941598-b6b500a502a7?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
          alt="profile avatar"
          style="border-radius: 9999px;"
        />
      </div>
      <div class="col-10">
        <p class="fs-4 fw-medium"><?php echo $_SESSION['user']['username']?></p>
        <div class="row">
          <div class="col-4">
            <p><i class="fa-solid fa-person"></i><span>200+</span></p>
            <p><i class="fa-solid fa-envelope"></i><?php echo $_SESSION['user']['email'] ?></p>
            <p><i class="fa-solid fa-house"></i><span class="prompt">Edit to add your address</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section" id="description">
      <p>About Us</p>
      <p class="prompt">Edit to add your company description</p>
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
