<?php
class TempController {
  const DEFAULT_VIEW_FOLDER = 'views/temp/';
  public function profile() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'profile.php');
    $content = ob_get_clean();
    return $content;
  }

  public function edit_profile() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'profile.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
