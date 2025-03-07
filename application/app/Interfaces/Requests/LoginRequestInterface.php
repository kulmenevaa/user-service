<?php declare(strict_types=1);

namespace App\Interfaces\Requests;

interface LoginRequestInterface
{
    public function getPhone(): ?string;

    public function getEmail(): ?string;

    public function getPassword(): string;

    public function getCredentials(): array;
}