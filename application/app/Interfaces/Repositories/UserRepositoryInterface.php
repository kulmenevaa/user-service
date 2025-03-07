<?php declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\User;
use App\Interfaces\Requests\ListUserRequestInterface;
use App\Interfaces\Requests\SaveUserRequestInterface;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(ListUserRequestInterface $request): Collection;

    public function create(SaveUserRequestInterface $request): User;

    public function first(string $id): ?User;

    public function update(string $id, SaveUserRequestInterface $request): ?User;

    public function delete(string $id): ?bool;
}