<?php declare(strict_types=1);

namespace App\Interfaces\Requests;

interface SaveUserRequestInterface
{
    public function getSurname(): string;

    public function getName(): string;

    public function getPatronymic(): ?string;

    public function getPhone(): string;

    public function getEmail(): string;

    public function getPassword(): string;

    public function getGender(): ?string;

    public function getUserData(): array;
}