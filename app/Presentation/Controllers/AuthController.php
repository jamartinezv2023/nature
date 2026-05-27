<?php

namespace App\Presentation\Controllers;

class AuthController
{
    public function index()
    {
        require __DIR__
            . '/../../../public/views/login.php';
    }

    public function login()
    {
        $_SESSION['user'] = 'JM';

        $_SESSION['otp'] = 172717;

        $_SESSION['otp_expires_at']
            = time() + 300;

        header(
            'Location: /verify-otp'
        );

        exit;
    }
}
