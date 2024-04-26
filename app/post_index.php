<?php
require_once 'models/User.php';
if($_POST['action'] == 'login') {
  echo "";
} else if($_POST['action'] == 'create_user') {
  User::create($_POST);
}
?>
