<?php

namespace App\Providers;

use App\Services\NasaService;
use Illuminate\Support\ServiceProvider;

class NasaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(NasaService::class, function ($app) {
            return new NasaService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
