<?php
require_once "models/Job.php";
class JobsController {
  const DEFAULT_VIEW_FOLDER = 'views/jobs/';
  public function show() {
    $job = Job::getJob($_GET['job']);
    if($_SESSION['user']['type'] == 'employer') {
      $applied_candidates = Job::getAppliedCandidates($_GET['job']);
    }
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'job.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
