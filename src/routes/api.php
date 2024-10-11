<?php

$router->post('/user', function($request) {
  echo json_encode($request);
});

$router->put('/user', function($request) {
  echo json_encode($request);
});

$router->delete('/user', function($request) {
  echo json_encode($request);
});