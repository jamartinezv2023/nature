<?php

namespace Nature\Core\Domain\Models;

class User
{
    private string $id;
    private string $tenantId;
    private string $email;
    private string $passwordHash;
    private ?string $twoFactorSecret;
    private bool $isTwoFactorEnabled;

    public function __construct(
        string $id,
        string $tenantId,
        string $email,
        string $passwordHash,
        ?string $twoFactorSecret,
        bool $isTwoFactorEnabled
    ) {
        $this->id = $id;
        $this->tenantId = $tenantId;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->twoFactorSecret = $twoFactorSecret;
        $this->isTwoFactorEnabled = $isTwoFactorEnabled;
    }

    public function getId(): string { return $this->id; }
    public function getTenantId(): string { return $this->tenantId; }
    public function getEmail(): string { return $this->email; }
    public function getPasswordHash(): string { return $this->passwordHash; }
    public function getTwoFactorSecret(): ?string { return $this->twoFactorSecret; }
    public function isTwoFactorEnabled(): bool { return $this->isTwoFactorEnabled; }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }
}
