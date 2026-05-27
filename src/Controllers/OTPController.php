<?php

header('Content-Type: application/json');

$rawInput =
    file_get_contents("php://input");

$data =
    json_decode($rawInput, true);

$otp =
    $data['otp'] ?? null;

/*
|--------------------------------------------------------------------------
| VALIDACIÓN ENTERPRISE
|--------------------------------------------------------------------------
*/

if (!$otp) {

    echo json_encode([
        'success' => false,
        'message' => 'OTP requerido'
    ]);

    exit;
}

/*
|--------------------------------------------------------------------------
| OTP DEMO ENTERPRISE
|--------------------------------------------------------------------------
*/

if (strlen($otp) === 6) {

    $_SESSION['authenticated'] = true;

    echo json_encode([
        'success' => true,
        'message' => 'OTP validado correctamente',
        'redirect' => '/dashboard'
    ]);

    exit;
}

/*
|--------------------------------------------------------------------------
| OTP INVÁLIDO
|--------------------------------------------------------------------------
*/

echo json_encode([
    'success' => false,
    'message' => 'OTP inválido'
]);
