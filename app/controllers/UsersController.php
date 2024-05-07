<?php
require_once "models/User.php";
class UsersController {
  const DEFAULT_VIEW_FOLDER = 'views/users/';

  public function new() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'register.php');
    $content = ob_get_clean();
    return $content;
  }

  public function get_cv() {
    $user = User::get_user_by_id($_GET['cv']);
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'cv.php');
    $content = ob_get_clean();
    return $content;
  }

  public function upload_cv() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'upload_cv.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
