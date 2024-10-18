# Route Forge PHP

Configuring routes:

```php
$router = new Router(); // instance of the Router class

// routes here

$router->get('/', function () {
  echo json_encode(['Project' => 'API SQLite']);
});

$router->post('/user', function ($request) {
  echo json_encode($request); // request body stored in an object in the $request variable
});

$router->put('/user/:id', function ($id, $request) {
  echo json_encode([
    "id"=>$id,
    "body"=>$request->body,
    "params"=>$request->params
  ]);
});

$router->delete('/user/:id', function ($id) {
  echo "user with id {$id} has been deleted.";
});

//end routes

$router->resolve(); // init routes
// the $router->resolve() method must always be called at the end of routes.
```

## Request data

The request data is stored in the $request variable.
Parameters of type $_GET are stored in an object called "params" within the $request variable "$request->params".
Parameters of type $_POST are stored in an Object called "body" within the $request variable "$request->body".
For PUT and DELETE requests, the request data is stored in the "$request->body" variable.

```php
$router->post('/user', function ($request) {
  $urlParams = $request->params // request params ($_GET) stored in an object in the $request variable
  $requestBody = $request->body // request body ($_POST) stored in an object in the $request variable
});

$router->put('/user', function ($request) {
  $urlParams = $request->params // request params ($_GET) stored in an object in the $request variable
  $requestBody = $request->body // request body stored in an object in the $request variable
});

$router->delete('/user', function ($request) {
  $urlParams = $request->params // request params ($_GET) stored in an object in the $request variable
  $requestBody = $request->body // request body stored in an object in the $request variable
});
```