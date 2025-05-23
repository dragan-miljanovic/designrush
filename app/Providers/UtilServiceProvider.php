<?php

namespace App\Providers;

use App\Utils\Contracts\LoggerInterface;
use App\Utils\LogHelper;
use Illuminate\Support\ServiceProvider;

class UtilServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LoggerInterface::class, LogHelper::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
