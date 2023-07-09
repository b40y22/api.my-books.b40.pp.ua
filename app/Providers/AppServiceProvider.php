<?php

namespace App\Providers;

use App\Src\Services\Auth\AuthServiceInterface;
use App\Src\Services\Auth\LoginService;
use App\Src\Services\Author\AuthorListService;
use App\Src\Services\Author\Interfaces\AuthorListServiceInterface;
use App\Src\Services\Book\BookStoreService;
use App\Src\Services\Book\BookUpdateService;
use App\Src\Services\Book\Interfaces\BookStoreServiceInterface;
use App\Src\Services\Book\Interfaces\BookUpdateServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, LoginService::class);
        $this->app->bind(AuthorListServiceInterface::class, AuthorListService::class);
        $this->app->bind(BookStoreServiceInterface::class, BookStoreService::class);
        $this->app->bind(BookUpdateServiceInterface::class, BookUpdateService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
