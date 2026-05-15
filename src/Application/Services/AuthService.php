<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Infrastructure\Repositories\UserRepository;

class AuthService
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function login(
        string $email,
        string $password
    ): array|false {

        $user = $this->repository->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (
            !password_verify(
                $password,
                $user['password_hash']
            )
        ) {
            return false;
        }

        if ($user['estado'] !== 'ACTIVO') {
            return false;
        }

        return $user;
    }

    public function generateOTP(): int
    {
        return random_int(100000, 999999);
    }
}
