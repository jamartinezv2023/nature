<?php

$db =
    new PDO(
        'sqlite:' . __DIR__ . '/../database/database.sqlite'
    );

$query =
    $db->query("
        SELECT
            id,
            full_name,
            email,
            role
        FROM users
    ");

$users =
    $query->fetchAll(PDO::FETCH_ASSOC);

echo PHP_EOL;

echo "======================================" . PHP_EOL;
echo " USUARIOS ENTERPRISE REGISTRADOS" . PHP_EOL;
echo "======================================" . PHP_EOL;

foreach ($users as $user) {

    echo
        $user['id']
        . " | "
        . $user['full_name']
        . " | "
        . $user['email']
        . " | "
        . $user['role']
        . PHP_EOL;
}

echo PHP_EOL;
