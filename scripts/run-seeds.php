<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Shared/Helpers/bootstrap.php';

use App\Infrastructure\Persistence\Database;

$connection =
    Database::connection();

$seedFile =
    __DIR__
    . '/../database/seeders/001_palmira_seed.sql';

$sql =
    file_get_contents($seedFile);

try {

    $connection->exec($sql);

    echo PHP_EOL;
    echo "==================================" . PHP_EOL;
    echo " SEEDERS ENTERPRISE EJECUTADOS " . PHP_EOL;
    echo "==================================" . PHP_EOL;
    echo PHP_EOL;

} catch (Throwable $e) {

    echo PHP_EOL;
    echo "ERROR EJECUTANDO SEEDS" . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
}
