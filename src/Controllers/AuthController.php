<?php

declare(strict_types=1);

use App\Application\Services\AuthService;
use App\Application\Services\OTPService;
use App\Infrastructure\Container\AppContainer;
use App\Infrastructure\Utils\Mailer;

$app = require __DIR__ . '/../../bootstrap/app.php';

$container = new AppContainer(
    $app['pdo']
);

$authService = $container->get(
    AuthService::class
);

try {

    $email = trim(
        $_POST['email'] ?? ''
    );

    $password = trim(
        $_POST['password'] ?? ''
    );

    if (
        empty($email)
        || empty($password)
    ) {

        header(
            'Location: /?error=1'
        );

        exit;
    }

    $usuario = $authService->login(
        $email,
        $password
    );

    if (!$usuario) {

        header(
            'Location: /?error=1'
        );

        exit;
    }

    $_SESSION['usuario_id']
        = $usuario['id'];

    $_SESSION['usuario_nombre']
        = $usuario['nombre'];

    $_SESSION['usuario_email']
        = $usuario['email'];

    $_SESSION['usuario_rol']
        = $usuario['rol'];

    $otpService = new OTPService();

    $otp = $otpService->generate();

    $otpService->store(
        $otp,
        $usuario['email']
    );

    Mailer::sendOTP(
        $usuario['email'],
        $otp
    );

    header(
        'Location: /verify-otp'
    );

    exit;

} catch (Throwable $e) {

    echo '<pre>';

    echo $e->getMessage();

    echo PHP_EOL;

    echo $e->getFile();

    echo PHP_EOL;

    echo $e->getLine();

    echo '</pre>';

    exit;
}
