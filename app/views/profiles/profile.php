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
    <button id="active"><a><i class="fa-solid fa-user"></i><span>My profile</span></a></button>
    <button><a><i class="fa-solid fa-suitcase"></i><span>My applied jobs</span></a></button>
    <button><a href="/profile/cv"><i class="fa-solid fa-file"></i><span>My CV</span></a></button>
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
            <p><i class="fa-solid fa-suitcase"></i>
              <?php if($_SESSION['user']['cv']['current_position']) {
                echo $_SESSION['user']['cv']['current_position'];
              } else {
                echo '<span class="prompt">Edit to add your current position</span>';
              }?>
            </p>
            <p><i class="fa-solid fa-envelope"></i><span><?php echo $_SESSION['user']['email'] ?></span></p>
            <p><i class="fa-solid fa-house"></i><span class="prompt">Edit to add your address</span></p>
          </div>
          <div class="col-4">
            <p><i class="fa-solid fa-user-graduate"></i>
              <?php if($_SESSION['user']['cv']['highest_degree']) {
                echo $_SESSION['user']['cv']['highest_degree'];
              } else {
                echo '<span class="prompt">Edit to add your highest degree</span>';
              }?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="profile-section mt-2" id="desired-job">
      <p>Desired Job</p>
      <div class="row">
        <p class="col-2">Location</p>
        <p class="col-2 prompt">Edit to add location</p>
      </div>
      <div class="row">
        <p class="col-2">Expected Salary</p>
        <p class="col-2">              
          <?php if($_SESSION['user']['cv']['desired_job_salary']) {
            echo $_SESSION['user']['cv']['desired_job_salary'];
          } else {
            echo '<span class="prompt">Edit to add expected salary</span>';
          }?>
        </p>
      </div>
      <div class="row">
        <p class="col-2">Willing to relocation</p>
        <p class="col-2">
        <?php 
          if($_SESSION['user']['cv']['willing_to_relocation'] !== null) {
          echo $_SESSION['user']['cv']['willing_to_relocation'] == 0 ? "No" : "Yes";
        } else {
          echo '<span class="prompt">Edit to add your decision</span>';
        }?>
        </p>
      </div>
    </div> 
    <div class="profile-section" id="career-goals">
      <p>Career Goals</p>
      <p>
        <?php if($_SESSION['user']['cv']['career_goal']) {
          echo $_SESSION['user']['cv']['career_goal'];
        } else {
          echo '<span class="prompt">Edit to add career goals</span>';
        }?>
      </p>
    </div> 
    <div class="profile-section" id="experiences">
      <p>Experiences</p>
      <p>
        <?php if($_SESSION['user']['cv']['experiences']) {
          echo $_SESSION['user']['cv']['experiences'];
        } else {
          echo '<span class="prompt">Edit to add experiences</span>';
        }?>
      </p>
    </div> 
    <div class="profile-section" id="education">
      <p>Education</p>
      <p>
        <?php if($_SESSION['user']['cv']['education']) {
          echo $_SESSION['user']['cv']['education'];
        } else {
          echo '<span class="prompt">Edit to add education</span>';
        }?>
      </p>
    </div> 
    <div class="profile-section" id="skills">
      <p>Skills</p>
      <p class="prompt">Edit to add skills</p>
    </div> 
    <div class="profile-section" id="languages">
      <p>Languages</p>
      <p class="prompt">Edit to add languages</p>
    </div> 
  </div>
</div>
