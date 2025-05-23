<?php

namespace App\Providers;

use App\Repositories\Contracts\ServiceProviderRepositoryInterface;
use App\Repositories\ServiceProviderRepository;
use App\Services\ServiceProvider\Contracts\ServiceProviderServiceInterface;
use App\Services\ServiceProvider\ServiceProviderService;
use Illuminate\Support\ServiceProvider;

class ServiceProviderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ServiceProviderRepositoryInterface::class, ServiceProviderRepository::class);
        $this->app->singleton(ServiceProviderServiceInterface::class, ServiceProviderService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
