<?php
class PagesController {
  const DEFAULT_VIEW_FOLDER = 'views/pages/';
  public function home() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'home.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
