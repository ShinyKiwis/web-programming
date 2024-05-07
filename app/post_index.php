<?php
require_once 'models/User.php';
require_once 'models/Job.php';
require_once 'controllers/SessionsController.php';
if($_POST['action'] == 'login') {
  $sessionController = new SessionsController();
  $sessionController->create($_POST);
} else if($_POST['action'] == 'create_user') {
  User::create($_POST);
} else if($_POST['action'] == 'upload_cv') {
  User::upload_cv($_FILES, $_POST['user_id']);
} else if($_POST['action'] == 'get_cv'){
  User::get_cv_by_id($_POST);
} else if($_POST['action'] == 'update_user') {
  User::update($_POST);
} else if($_POST['action'] == 'create_job') {
  Job::create($_POST);
} else if($_POST['action'] == 'update_company') {
  Company::update($_POST);
}
?>
