<?php declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Requests\LoginRequestInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {

    }

    private function getAuthUser(): User
    {
        return auth()->guard()->user();
    }
    
    /**
     * authorization
     *
     * @param  LoginRequestInterface $request
     * @return UserResource
     */
    public function authorization(LoginRequestInterface $request): UserResource
    {
        if (Auth::attempt($request->getCredentials())) {
            $user = $this->getAuthUser();
            $token = $user->createToken($user->email);
            $user->withAccessToken($token->accessToken);
            
            return UserResource::make($user);
        }
        throw new UnauthorizedHttpException(__METHOD__, __('auth.failed'));
    }
    
    /**
     * loggingOut
     *
     * @return bool
     */
    public function loggingOut(): bool
    {
        return $this->getAuthUser()->token()->revoke();
    }
}