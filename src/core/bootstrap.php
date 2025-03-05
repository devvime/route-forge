<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/utils.php";
require_once __DIR__ . "/router.php";
require_once __DIR__ . "/crud.php";
require_once __DIR__ . "/../modules.php";

$router = new Router();

require_once __DIR__ . "/../routes/api.php";
require_once __DIR__ . "/../routes/front.php";

$router->resolve();