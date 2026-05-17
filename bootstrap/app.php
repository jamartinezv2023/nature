<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$env = parse_ini_file(__DIR__ . '/../.env');

foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}
