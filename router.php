<?php

// Autocarga de clases básica (PSR-4 simulado para mantener compatibilidad nativa en Laragon)
spl_autoload_register(function ($class) {
    $prefix = 'Nature\\';
    $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Capturar la URI solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Enrutar la petición asíncrona de autenticación
if ($uri === '/api/auth/login') {
    try {
        // 1. Inicializar la infraestructura (Driven Adapter)
        $db = \Nature\Adapters\Driven\Persistence\DatabaseConnection::getInstance();
        $userRepository = new \Nature\Adapters\Driven\Persistence\MysqlUserRepository($db);

        // 2. Inicializar el servicio del Core (Domain)
        $authService = new \Nature\Core\Domain\Services\AuthService($userRepository);

        // 3. Inicializar el adaptador de entrada (Driving Adapter) y delegar el control
        $controller = new \Nature\Adapters\Driving\Http\LoginController($authService);
        $controller->handleRequest();
        exit;
    } catch (\Exception $e) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}

// Si la petición es para un archivo estático en public/, dejar que el servidor nativo de PHP lo sirva
$file = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false; 
}

// Por defecto, si entra a la raíz o no existe el archivo, cargar la interfaz de login
require_once __DIR__ . '/public/login.php';
