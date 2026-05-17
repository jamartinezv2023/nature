<?php

declare(strict_types=1);

namespace App\Application\Services;

class OTPService
{
    public function generate(): int
    {
        return random_int(100000, 999999);
    }

    public function store(
        int $otp,
        string $email
    ): void {

        $_SESSION['otp'] = $otp;

        $_SESSION['otp_email'] = $email;

        $_SESSION['otp_expires_at']
            = time() + 300;
    }

    public function validate(
        int $otp
    ): bool {

        if (
            !isset($_SESSION['otp'])
        ) {
            return false;
        }

        if (
            time()
            > $_SESSION['otp_expires_at']
        ) {
            return false;
        }

        return $_SESSION['otp'] === $otp;
    }

    public function clear(): void
    {
        unset($_SESSION['otp']);

        unset($_SESSION['otp_email']);

        unset($_SESSION['otp_expires_at']);
    }
}
