<?php

namespace App\Presentation\Controllers;

class AuthController
{
    public function index()
    {
        require __DIR__ . '/../../../public/views/login.php';
    }

    public function login()
    {
        $_SESSION['user'] = 'JM';

        header('Location: /dashboard');

        exit;
    }
}
