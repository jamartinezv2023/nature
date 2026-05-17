<?php

require_once __DIR__ . '/../bootstrap/app.php';

$routes = require __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri !== '/' && str_ends_with($uri, '/')) {
    $uri = rtrim($uri, '/');
}

if (isset($routes[$uri])) {

    [$controller, $method] = $routes[$uri];

    $instance = new $controller();

    $instance->$method();

    exit;
}

http_response_code(404);

echo "404 NOT FOUND";
