<?php

require_once __DIR__ . "/../src/config.php";
require_once __DIR__ . "/utils.php";
require_once __DIR__ . "/router.php";
require_once __DIR__ . "/crud.php";
require_once __DIR__ . "/../src/modules.php";

$router = new Router();

require_once __DIR__ . "/../src/routes/api.php";
require_once __DIR__ . "/../src/routes/front.php";

$router->resolve();