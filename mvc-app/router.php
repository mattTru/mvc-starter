<?php
//
// FILE :  / mvc-app / router.php
// The engine for routing uses the vendor / nikic / fast-route component
// The routing engine reads the routes in the routes.php file
//   

// ROUTING
// Read the possible routes
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
  include 'routes.php';
});

// Retrieve the method and the URL proposed by the client
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = trim(str_replace(ROOT_URL, '', $_SERVER['REQUEST_URI']));

// Remove parameters (?foo=bar)
if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Analyze the order
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

// Process the order (if possible)
switch ($routeInfo[0]) {

    // The order does not exist
  case FastRoute\Dispatcher::NOT_FOUND:
    $twig->display(
      '404.html.twig'
    );
    break;

    // The command exists but the method is incorrect
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    // ... 405 Method Not Allowed
    break;

    // The order is known
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];

    // analyze the route to detect a write in controller@method
    $params = explode('@', $handler);

    // if the action to be carried out is well described in the form controller@method
    if (count($params) > 1) {
      // Process controller method
      // Controllers use namespace
      // post@index must call Controllers \ PostController method index
      $controller = "App\Controllers\\" . $params[0];
      try {
        // Controller class does not exist ...
        if (class_exists($controller) === false) {
          echo "<h1>The controller '$controller' does not exist.</h1>";
          die();
        }
        $controller = new $controller;
        $action = $params[1];
        // The controller method does not exist ...
        if (method_exists($controller, $action) === false) {
          echo "<h1>The method  '$action' of the controller does not exist.</h1>";
          die();
        }
        // Call controller method
        return call_user_func_array([$controller, $action], $vars);
      } catch (\Core\Router\RooterException $exception) {
        echo 'HTTP Error 404 Not Found';
      }
    } else {
      // Otherwise, call the anonymous function
      call_user_func_array($handler, $vars);
    }
    break;
}
