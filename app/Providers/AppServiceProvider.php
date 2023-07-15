<?php

namespace App\Providers;

use App\Src\Services\Auth\AuthServiceInterface;
use App\Src\Services\Auth\LoginService;
use App\Src\Services\Author\AuthorListService;
use App\Src\Services\Author\Interfaces\AuthorListServiceInterface;
use App\Src\Services\Book\BookListService;
use App\Src\Services\Book\BookStoreService;
use App\Src\Services\Book\BookUpdateService;
use App\Src\Services\Book\Interfaces\BookListServiceInterface;
use App\Src\Services\Book\Interfaces\BookStoreServiceInterface;
use App\Src\Services\Book\Interfaces\BookUpdateServiceInterface;
use App\Src\Services\Import\Parser\ImportService;
use App\Src\Services\Import\Parser\ImportServiceInterface;
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
        $this->app->bind(BookListServiceInterface::class, BookListService::class);
        $this->app->bind(ImportServiceInterface::class, ImportService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
