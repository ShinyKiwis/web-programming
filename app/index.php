<?php
$routes = [
  "/register" => 'UsersController#new',
  "/login" => 'SessionsController#new',
  "/logout" => 'SessionsController#destroy',
  "/home" => 'PagesController#home',
  "/profile" => 'ProfilesController#show',
  "/profile/edit" => 'ProfilesController#edit',
  "/profile/cv" => "UsersController#upload_cv",
  "/company/profile" => 'CompaniesController#show',
  "/company/profile/edit" => 'CompaniesController#edit',
  "/company/add-job" => 'CompaniesController#add_job',
  "/home/candidate" => 'PagesController#candidate',
];

$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('?', $url);

if($urlParts[0] == "/welcome") {
  ob_start();
  $pageTitle = "Welcome | Work Seekers";
  include("views/welcome.html");
} else if(array_key_exists($urlParts[0], $routes)) {
  $mapping = $routes[$urlParts[0]];
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
