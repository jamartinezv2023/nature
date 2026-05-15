<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use PDO;

class UserRepository
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public function findByEmail(string $email): array|false
    {
        $sql = "
            SELECT
                u.*,
                r.nombre AS rol

            FROM usuarios u

            LEFT JOIN usuario_roles ur
                ON ur.usuario_id = u.id

            LEFT JOIN roles r
                ON r.id = ur.rol_id

            WHERE u.email = :email

            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
