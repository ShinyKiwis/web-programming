<?php
require_once "models/User.php";
class ProfilesController {
  const DEFAULT_VIEW_FOLDER = 'views/profiles/';
  public function show() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'profile.php');
    $content = ob_get_clean();
    return $content;
  }

  public function edit() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'edit_profile.php');
    $content = ob_get_clean();
    return $content;
  }

  public function getAppliedJobs() {
    $jobs = User::getAppliedJobs();
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'applied_job.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
