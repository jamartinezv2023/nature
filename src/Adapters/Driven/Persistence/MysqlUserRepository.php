<?php

namespace Nature\Adapters\Driven\Persistence;

use Nature\Core\Ports\Outgoing\UserRepositoryPort;
use Nature\Core\Domain\Models\User;
use PDO;

class MysqlUserRepository implements UserRepositoryPort
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Busca un usuario asegurando el aislamiento por Tenant (Multitenant)
     */
    public function findByEmailAndTenant(string $email, string $tenantId): ?User
    {
        // En un esquema SaaS con discriminador o esquema separado, validamos de forma estricta ambos parámetros
        $stmt = $this->connection->prepare(
            "SELECT id, tenant_id, email, password_hash, two_factor_secret, is_two_factor_enabled 
             FROM users 
             WHERE email = :email AND tenant_id = :tenant_id LIMIT 1"
        );

        $stmt->execute([
            'email' => $email,
            'tenant_id' => $tenantId
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        // Mapeo directo desde la base de datos relacional hacia el Modelo de Dominio puro
        return new User(
            (string)$row['id'],
            (string)$row['tenant_id'],
            (string)$row['email'],
            (string)$row['password_hash'],
            $row['two_factor_secret'],
            (bool)$row['is_two_factor_enabled']
        );
    }

    /**
     * Persiste el secreto del segundo factor de autenticación (2FA)
     */
    public function saveTwoFactorSecret(string $userId, string $secret): bool
    {
        $stmt = $this->connection->prepare(
            "UPDATE users 
             SET two_factor_secret = :secret 
             WHERE id = :id"
        );

        return $stmt->execute([
            'secret' => $secret,
            'id' => $userId
        ]);
    }
}
