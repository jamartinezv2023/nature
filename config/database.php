<?php
/**
 * NATURAE SaaS - Configuración de Infraestructura Relacional (3FN)
 */
define('DB_HOST', 'database'); 
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'nature_db');
define('DB_PORT', '3306');

try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage());
    die("Error crítico de infraestructura relacional.");
}
