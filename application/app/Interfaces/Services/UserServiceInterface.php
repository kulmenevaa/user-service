<?php declare(strict_types=1);

namespace App\Interfaces\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\Requests\ListUserRequestInterface;
use App\Interfaces\Requests\SaveUserRequestInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UserServiceInterface
{
    public function list(ListUserRequestInterface $request): AnonymousResourceCollection;

    public function register(SaveUserRequestInterface $request): UserResource;

    public function find(string $id): UserResource;

    public function upgrade(string $id, SaveUserRequestInterface $request): UserResource;

    public function remove(string $id): bool;
}