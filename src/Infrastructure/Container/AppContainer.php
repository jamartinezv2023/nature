<?php

declare(strict_types=1);

namespace App\Infrastructure\Container;

use PDO;

use App\Application\Services\AuthService;

use App\Infrastructure\Repositories\UserRepository;

class AppContainer
{
    private array $instances = [];

    public function __construct(
        private PDO $pdo
    ) {
    }

    public function get(
        string $service
    ): mixed {

        if (isset($this->instances[$service])) {

            return $this->instances[$service];
        }

        $instance = match ($service) {

            UserRepository::class
                => new UserRepository($this->pdo),

            AuthService::class
                => new AuthService(
                    $this->get(
                        UserRepository::class
                    )
                ),

            default
                => throw new \Exception(
                    "Service not found: {$service}"
                )
        };

        $this->instances[$service]
            = $instance;

        return $instance;
    }
}
