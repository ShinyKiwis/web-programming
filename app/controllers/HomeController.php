<?php 
class HomeController {
  const DEFAULT_VIEW_FOLDER = 'views/home/';
  public function index() {
    http_response_code(200);
    include self::DEFAULT_VIEW_FOLDER . "index.html";
  }
}
?>
