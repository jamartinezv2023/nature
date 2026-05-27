<?php

namespace Nature\Interfaces\Http\Controllers;

use PDO;
use Nature\Application\Services\AuthService;

class LoginController
{
    public function handle(): void
    {
        header('Content-Type: application/json');

        $raw =
            file_get_contents("php://input");

        $data =
            json_decode($raw, true);

        $email =
            $data['email'] ?? '';

        $password =
            $data['password'] ?? '';

        $db =
            new PDO(
                'sqlite:' . __DIR__
                . '/../../../../database/database.sqlite'
            );

        $authService =
            new AuthService($db);

        $result =
            $authService->login(
                $email,
                $password
            );

        echo json_encode($result);
    }
}
