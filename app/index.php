<?php
$routes = [
  "/register" => 'UsersController#new',
  "/login" => 'SessionsController#new',
  "/logout" => 'SessionsController#destroy',
  "/home" => 'PagesController#home',
  "/profile" => 'TempController#profile',
  "/profile/edit" => 'TempController#edit_profile',
  "/profile/cv" => "UsersController#upload_cv",
];

$url = $_SERVER['REQUEST_URI'];

if($url == "/welcome") {
  ob_start();
  $pageTitle = "Welcome | Work Seekers";
  include("views/welcome.html");
} else if(array_key_exists($url, $routes)) {
  $mapping = $routes[$url];
  list($controllerName, $actionName) = explode('#', $mapping);

  require_once('controllers/' . $controllerName . '.php');
  $controller = new $controllerName();
  $content = $controller->$actionName();
  include "views/layout.php";
} else {
  http_response_code(404);
  include('views/404.html');
}
?>
