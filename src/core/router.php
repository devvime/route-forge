<?php

class Router
{
  private $routes = [];

  public function get($route, $callback)
  {
    $this->routes['GET'][$route] = $callback;
  }

  public function post($route, $callback)
  {
    $this->routes['POST'][$route] = $callback;
  }

  public function put($route, $callback)
  {
    $this->routes['PUT'][$route] = $callback;
  }

  public function delete($route, $callback)
  {
    $this->routes['DELETE'][$route] = $callback;
  }

  public function resolve()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($this->routes[$method] as $route => $callback) {
      $pattern = preg_replace('/\/:[^\/]+/', '/([^/]+)', $route);
      if (preg_match("#^$pattern$#", $path, $matches)) {
        array_shift($matches);

        $request = [];
        if ($method === 'GET') {
          $request = $_GET;
        } elseif ($method === 'POST') {
          $request = $_POST;
        } elseif ($method === 'PUT' || $method === 'DELETE') {
          parse_str(file_get_contents("php://input"), $request);
        }
        
        call_user_func_array($callback, array_merge($matches, [$request]));
        return;
      }
    }

    echo "Route not found.";
  }
}
