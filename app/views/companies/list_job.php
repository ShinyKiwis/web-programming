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
    <button><a href="/company/profile/edit"><i class="fa-solid fa-pen"></i><span>Edit company profile</span></a></button>
    <button><a href="/company/profile"><i class="fa-solid fa-user"></i><span>Company profile</span></a></button>
    <button id="active"><a href="/company/list-job"><i class="fa-solid fa-suitcase"></i><span>Listed jobs</span></a></button>
    <button><a href="/company/add-job"><i class="fa-solid fa-file"></i><span>Add new job</span></a></button>
  </div>
  <div class="col-10 p-4 h-100" id="profile">
    <div class="row">
      <p class="fs-4 fw-medium">Listed Jobs</p>
      <?php foreach($jobs as $job ) { ?>
        <a href="/job?job=<?php echo $job['id']?>"><?php echo $job['name']; ?></a>
      <?php } ?>
    </div>
  </div>
</div>
<script>

</script>
