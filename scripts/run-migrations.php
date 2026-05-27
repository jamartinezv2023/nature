<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Shared/Helpers/bootstrap.php';

use App\Infrastructure\Persistence\Database;

$connection =
    Database::connection();

$migrationFile =
    __DIR__
    . '/../database/migrations/001_enterprise_multitenant.sql';

$sql =
    file_get_contents($migrationFile);

try {

    $connection->exec($sql);

    echo PHP_EOL;
    echo "======================================" . PHP_EOL;
    echo " MIGRACIONES ENTERPRISE EJECUTADAS " . PHP_EOL;
    echo "======================================" . PHP_EOL;
    echo PHP_EOL;

} catch (Throwable $e) {

    echo PHP_EOL;
    echo "ERROR EJECUTANDO MIGRACIONES" . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
}
