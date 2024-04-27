<?php
class PagesController {
  const DEFAULT_VIEW_FOLDER = 'views/pages/';
  public function feeds() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'feeds.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
