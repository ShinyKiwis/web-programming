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
    <button><a href="/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit your profile</span></a></button>
    <button><a href="/profile"><i class="fa-solid fa-user"></i><span>My profile</span></a></button>
    <button id="active"><a href="/profile/applied-job"><i class="fa-solid fa-suitcase"></i><span>My applied jobs</span></a></button>
    <button><a href="/profile/cv"><i class="fa-solid fa-file"></i><span>My CV</span></a></button>
  </div>
  <div class="col-10 p-4 h-100" id="profile">
    <div class="row">
      <p class="fs-4 fw-medium">Applied Jobs</p>
      <?php foreach($jobs as $job ) { ?>
        <a href="/job?job=<?php echo $job['id']?>"><?php echo $job['name']; ?></a>
      <?php } ?>
    </div>
  </div>
</div>
<script>

</script>
