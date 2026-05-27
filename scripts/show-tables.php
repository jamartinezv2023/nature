<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Shared/Helpers/bootstrap.php';

use App\Infrastructure\Persistence\Database;

$connection =
    Database::connection();

$query =
    $connection->query("
        SELECT name
        FROM sqlite_master
        WHERE type='table'
    ");

$tables =
    $query->fetchAll(PDO::FETCH_ASSOC);

echo PHP_EOL;
echo "========= TABLAS =========" . PHP_EOL;
echo PHP_EOL;

foreach ($tables as $table) {

    echo "- " . $table['name'] . PHP_EOL;
}

echo PHP_EOL;
