<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

$publicPath = __DIR__ . '/public';

$file = $publicPath . $uri;

if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require_once $publicPath . '/index.php';
