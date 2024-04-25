<?php
$routes = [
  "/register" => 'UsersController#new',
  "/login" => 'SessionsController#new'
];

$url = $_SERVER['REQUEST_URI'];

if(array_key_exists($url, $routes)) {
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
