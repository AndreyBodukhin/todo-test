<?php

namespace App\Providers;

use App\Infrastructure\ImageResizerAdapter;
use App\Services\Images\ImageResizer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        $this->app->singleton(ImageResizer::class, static fn($app) => new ImageResizerAdapter());
    }
}
