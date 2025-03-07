<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\Requests\SaveUserRequestInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Requests\ListUserRequestInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $user
    ) {
        
    }

    public function all(ListUserRequestInterface $request): Collection
    {
        $query = $this->user->query();

        if ($limit = $request->getLimit()) {
            $query->limit($limit);
        }

        $query->latest('created_at');

        if ($paginate = $request->getPaginate()) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    public function create(SaveUserRequestInterface $request): User
    {
        return $this->user->create($request->getUserData());
    }

    public function first(string $id): ?User
    {
        return $this->user->where('id', $id)->first();
    }

    public function update(string $id, SaveUserRequestInterface $request): ?User
    {
        if ($user = $this->first($id)) {
            $user->update($request->getUserData());
            return $user;
        }
        return null;
    }

    public function delete(string $id): bool
    {
        return (bool)$this->user->where('id', $id)->delete();
    }
}