<?php

namespace Nature\Application\Services;

use PDO;

class AuthService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function login(
        string $email,
        string $password
    ): array {

        $query =
            $this->db->prepare("
                SELECT *
                FROM users
                WHERE email = :email
                LIMIT 1
            ");

        $query->execute([
            'email' => $email
        ]);

        $user =
            $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {

            return [
                'success' => false,
                'message' => 'Usuario no encontrado'
            ];
        }

        if (
            !password_verify(
                $password,
                $user['password']
            )
        ) {

            return [
                'success' => false,
                'message' => 'Contraseña inválida'
            ];
        }

        $_SESSION['authenticated'] = true;

        $_SESSION['user'] = [
            'id' => $user['id'],
            'tenant_id' => $user['tenant_id'],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        return [
            'success' => true,
            'message' => 'Autenticación correcta'
        ];
    }
}
