<?php
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
}
?>
