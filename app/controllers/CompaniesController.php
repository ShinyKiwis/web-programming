<?php
class CompaniesController {
  const DEFAULT_VIEW_FOLDER = 'views/companies/';

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
}
?>
