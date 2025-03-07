<?php declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\AuthServiceInterface;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService
    ) {
        
    }

    /**
     * login
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->responseJson(
            $this->authService->authorization($request)
        );
    }

    /**
     * logout
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->responseJson(
            $this->authService->loggingOut()
        );
    }
}
