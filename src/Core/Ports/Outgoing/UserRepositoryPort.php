<?php

namespace Nature\Core\Ports\Outgoing;

use Nature\Core\Domain\Models\User;

interface UserRepositoryPort
{
    /**
     * Busca un usuario mapeando su pertenencia al Tenant correspondiente.
     */
    public function findByEmailAndTenant(string $email, string $tenantId): ?User;
    
    /**
     * Actualiza el secreto 2FA del usuario de manera persistente.
     */
    public function saveTwoFactorSecret(string $userId, string $secret): bool;
}
