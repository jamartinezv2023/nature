<?php

namespace Nature\Core\Domain\Services;

use Nature\Core\Ports\Outgoing\UserRepositoryPort;
use Nature\Core\Domain\Models\User;
use Exception;

class AuthService
{
    private UserRepositoryPort $userRepository;

    public function __construct(UserRepositoryPort $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticateFirstFactor(string $email, string $password, string $tenantId): User
    {
        $user = $this->userRepository->findByEmailAndTenant($email, $tenantId);

        if (!$user || !$user->verifyPassword($password)) {
            throw new Exception("Credenciales de acceso inválidas para la institución especificada.");
        }

        return $user;
    }

    public function verifySecondFactor(User $user, string $otpCode): bool
    {
        if (!$user->isTwoFactorEnabled()) {
            return true;
        }

        // Aquí se aplicará el algoritmo TOTP estándar de manera puramente matemática
        // o delegando a un puerto verificador. Por ahora simulamos la validación base.
        if (empty($otpCode)) {
            return false;
        }

        return true; 
    }
}
