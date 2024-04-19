<?php
class UsersController {
  const DEFAULT_VIEW_FOLDER = 'views/users/';

  public function new() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'login.php');
    $content = ob_get_clean();
    return $content;
  }
}
?>
