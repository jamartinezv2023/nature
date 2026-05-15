<?php

declare(strict_types=1);

namespace App\Infrastructure\Utils;

class Mailer
{
    public static function sendOTP(
        string $email,
        int $otp
    ): bool {

        $mensaje = "Su código OTP es: {$otp}";

        file_put_contents(
            __DIR__ . '/../../storage/mail/log.txt',
            date('Y-m-d H:i:s')
            . " -> {$email} -> {$mensaje}"
            . PHP_EOL,
            FILE_APPEND
        );

        return true;
    }
}
