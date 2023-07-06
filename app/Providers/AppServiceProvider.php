<?php

namespace App\Providers;

use App\Src\Services\Auth\AuthServiceInterface;
use App\Src\Services\Auth\LoginService;
use App\Src\Services\Book\BookServiceInterface;
use App\Src\Services\Book\BookStoreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, LoginService::class);
        $this->app->bind(BookServiceInterface::class, BookStoreService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
