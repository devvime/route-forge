# Route Master PHP

Configuring routes:

```php
$router = new Router(); // instance of the Router class

// routes here

$router->get('/', function () {
  echo json_encode(['Project' => 'API SQLite']);
});

$router->post('/user', function ($request) {
  echo json_encode($request); // request body stored in an array in the $request variable
});

$router->put('/user/:id', function ($id, $request) {
  echo json_encode([
    "id"=>$id,
    "body"=>$request
  ]);
});

$router->delete('/user/:id', function ($id) {
  echo "user with id {$id} has been deleted.";
});

//end routes

$router->resolve(); // init routes
// the $router->resolve() method must always be called at the end of routes.
```