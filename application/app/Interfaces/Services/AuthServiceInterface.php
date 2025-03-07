<?php declare(strict_types=1);

namespace App\Interfaces\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\Requests\LoginRequestInterface;

interface AuthServiceInterface
{
    public function authorization(LoginRequestInterface $request): UserResource;

    public function loggingOut(): bool;
}