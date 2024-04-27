<?php
require_once 'models/User.php';
require_once 'controllers/SessionsController.php';
if($_POST['action'] == 'login') {
  $sessionController = new SessionsController();
  $sessionController->create($_POST);
} else if($_POST['action'] == 'create_user') {
  User::create($_POST);
}
?>
