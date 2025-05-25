<?php

namespace App\Providers;

use App\Services\Cache\CacheService;
use App\Services\Cache\Contracts\CacheServiceInterface;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CacheServiceInterface::class, CacheService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
