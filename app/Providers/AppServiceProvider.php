<?php

namespace App\Providers;

use App\Src\Repositories\Eloquent\ExternalSourceRepository;
use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use App\Src\Services\Auth\Interfaces\AuthServiceInterface;
use App\Src\Services\Auth\LoginService;
use App\Src\Services\Author\AuthorListService;
use App\Src\Services\Author\Interfaces\AuthorListServiceInterface;
use App\Src\Services\Book\BookListService;
use App\Src\Services\Book\BookStoreService;
use App\Src\Services\Book\BookUpdateService;
use App\Src\Services\Book\Interfaces\BookListServiceInterface;
use App\Src\Services\Book\Interfaces\BookStoreServiceInterface;
use App\Src\Services\Book\Interfaces\BookUpdateServiceInterface;
use App\Src\Services\Images\ImageService;
use App\Src\Services\Images\Interfaces\ImageServiceInterface;
use App\Src\Services\Import\Parser\ImportService;
use App\Src\Services\Import\Parser\ImportServiceInterface;
use App\Src\Services\Monitoring\MonitoringService;
use App\Src\Services\Monitoring\MonitoringServiceInterface;
use App\Src\Services\User\Interfaces\UserUpdateServiceInterface;
use App\Src\Services\User\UserUpdateService;
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
        $this->app->bind(MonitoringServiceInterface::class, MonitoringService::class);
        $this->app->bind( ExternalSourceRepositoryInterface::class, ExternalSourceRepository::class);
        $this->app->bind( UserUpdateServiceInterface::class, UserUpdateService::class);
        $this->app->bind( ImageServiceInterface::class, ImageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
