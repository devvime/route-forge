<?php

$router->get('/user', $readUsers);
$router->post('/user', $createUsers);
$router->put('/user/:id', $updateUsers);
$router->delete('/user/:id', $deleteUsers);