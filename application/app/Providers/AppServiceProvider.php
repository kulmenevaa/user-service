<?php declare(strict_types=1);

namespace App\Providers;

use App\Services\AuthService;
use Laravel\Passport\Passport;
use App\Listeners\LogResponseSending;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Client\Events\ResponseReceived;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Event::listen(ResponseReceived::class, LogResponseSending::class);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
    }
}
