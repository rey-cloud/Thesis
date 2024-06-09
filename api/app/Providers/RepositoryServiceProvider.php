<?php

namespace App\Providers;

use App\Interface\Repository\AdminRepositoryInterface;
use App\Interface\Service\AuthenticationServiceInterface;
use App\Repository\AdminRepository;
use App\Service\AuthenticationService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);

        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
