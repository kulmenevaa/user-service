<?php declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Requests\ListUserRequestInterface;
use App\Interfaces\Requests\SaveUserRequestInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
        
    }

    public function list(ListUserRequestInterface $request): AnonymousResourceCollection
    {
        $users = $this->userRepository->all($request);
        return UserResource::collection($users);
    }

    public function register(SaveUserRequestInterface $request): UserResource
    {
        $user = $this->userRepository->create($request);
        return UserResource::make($user);
    }

    public function find(string $id): UserResource
    {
        $user = $this->userRepository->first($id);
        if ($user) return UserResource::make($user);

        throw new BadRequestHttpException(__('message.http.bad_request'));
    }

    public function upgrade(string $id, SaveUserRequestInterface $request): UserResource
    {
        $user = $this->userRepository->update($id, $request);
        if ($user) return UserResource::make($user);

        throw new BadRequestHttpException(__('message.http.bad_request'));
    }

    public function remove(string $id): bool
    {
        $deleted = $this->userRepository->delete($id);
        if ($deleted) return $deleted;
        
        throw new BadRequestHttpException(__('message.http.bad_request'));
    }
}