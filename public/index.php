<?php

declare(strict_types=1);


require_once __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../routes/web.php';

$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

/*
|--------------------------------------------------------------------------
| NORMALIZAR URI
|--------------------------------------------------------------------------
*/

$basePath = '/nature/public';

$uri = str_replace(
    $basePath,
    '',
    $uri
);

if ($uri === '') {
    $uri = '/';
}

/*
|--------------------------------------------------------------------------
| VALIDAR RUTA
|--------------------------------------------------------------------------
*/

if (!isset($routes[$method][$uri])) {

    http_response_code(404);

    echo '404 NOT FOUND';

    exit;
}

$route = $routes[$method][$uri];

/*
|--------------------------------------------------------------------------
| VIEW
|--------------------------------------------------------------------------
*/

if (isset($route['view'])) {

    require __DIR__
        . '/'
        . $route['view'];

    exit;
}

/*
|--------------------------------------------------------------------------
| CONTROLLER
|--------------------------------------------------------------------------
*/

if (isset($route['controller'])) {

    require __DIR__
        . '/../src/Controllers/'
        . $route['controller']
        . '.php';

    exit;
}

http_response_code(500);

echo '500 INTERNAL SERVER ERROR';
