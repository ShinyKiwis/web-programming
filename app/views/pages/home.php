<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: http://localhost:8080/login");
    exit();
}
?>
<div class="mx-5 mt-4 d-flex gap-4">
  <div class="card mb-3 col px-4 py-2">
    <div class="row">
      <div class="col-md-3 d-flex justify-content-center align-items-center">
        <img 
          src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
          class="rounded-start" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <a href="#" class="card-title">Senior Game Engineer</a>
          <p class="card-text">Ubisoft</p>
          <p class="card-text"><span class="text-danger">Salary Negotiation</span> | <span>Ho Chi Minh City</span></p>
          <p class="card-text"><small class="text-body-secondary">Last updated: Today</small></p>
          <span class="badge rounded-pill badge-primary">Unity</span>
          <span class="badge rounded-pill badge-primary">Algorithm</span>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-3 col px-4 py-2">
    <div class="row">
      <div class="col-md-3 d-flex justify-content-center align-items-center">
        <img 
          src="https://upload.wikimedia.org/wikipedia/commons/7/78/Ubisoft_logo.svg" 
          class="rounded-start" 
          alt="company logo" 
          style="width: 8em; height: 8em;"
        />
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <a href="#" class="card-title">Senior Game Engineer</a>
          <p class="card-text">Ubisoft</p>
          <p class="card-text"><span class="text-danger">Salary Negotiation</span> | <span>Ho Chi Minh City</span></p>
          <p class="card-text"><small class="text-body-secondary">Last updated: Today</small></p>
          <span class="badge rounded-pill badge-primary">Unity</span>
          <span class="badge rounded-pill badge-primary">Algorithm</span>
        </div>
      </div>
    </div>
  </div>
</div>
