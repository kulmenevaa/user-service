<?php declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListUserRequest;
use App\Http\Requests\SaveUserRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ListUserRequest $request): JsonResponse
    {
        return $this->responseJson(
            $this->userService->list($request)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveUserRequest $request): JsonResponse
    {
        return $this->responseJson(
            $this->userService->register($request)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->responseJson(
            $this->userService->find($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveUserRequest $request, string $id): JsonResponse
    {
        return $this->responseJson(
            $this->userService->upgrade($id, $request)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->responseJson(
            $this->userService->remove($id)
        );
    }
}
