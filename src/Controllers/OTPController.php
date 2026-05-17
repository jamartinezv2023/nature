<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Application\Services\OTPService;

$otpService = new OTPService();

$otp = trim(
    $_POST['otp'] ?? ''
);

if (
    !$otpService->validate(
        (int) $otp
    )
) {

    header(
        'Location: /verify-otp?error=1'
    );

    exit;
}

unset(
    $_SESSION['otp'],
    $_SESSION['otp_email'],
    $_SESSION['otp_expires_at']
);

header(
    'Location: /dashboard'
);

exit;
