<?php
$routes = [
  "/" => 'HomeController#index'
];

$url = $_SERVER['REQUEST_URI'];

if(array_key_exists($url, $routes)) {
  $mapping = $routes[$url];
  list($controllerName, $actionName) = explode('#', $mapping);

  require_once('controllers/' . $controllerName . '.php');
  $controller = new $controllerName();
  $controller->$actionName();
} else {
  http_response_code(404);
  include('views/404.html');
}
?>
