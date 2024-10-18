<?php

$router->get('/', function() {
  echo json_encode([
    'status' => 200,
    'message' => 'Welcome to API!'
  ]);
});