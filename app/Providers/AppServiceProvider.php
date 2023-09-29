<?php

namespace App\Providers;

use App\Repositories\Eloquent\ExternalSourceRepository;
use App\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use App\Services\Auth\LoginService;
use App\Services\Book\BookListService;
use App\Services\Book\BookStoreService;
use App\Services\Book\BookUpdateService;
use App\Services\Book\Interfaces\BookListServiceInterface;
use App\Services\Book\Interfaces\BookStoreServiceInterface;
use App\Services\Book\Interfaces\BookUpdateServiceInterface;
use App\Services\File\FileService;
use App\Services\File\FileServiceInterface;
use App\Services\Import\Parser\ImportService;
use App\Services\Import\Parser\ImportServiceInterface;
use App\Services\Monitoring\MonitoringService;
use App\Services\Monitoring\MonitoringServiceInterface;
use App\Services\User\Interfaces\UserPhotoUpdateServiceInterface;
use App\Services\User\Interfaces\UserUpdateServiceInterface;
use App\Services\User\UserPhotoUpdateService;
use App\Services\User\UserUpdateService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, LoginService::class);
        $this->app->bind(BookStoreServiceInterface::class, BookStoreService::class);
        $this->app->bind(BookUpdateServiceInterface::class, BookUpdateService::class);
        $this->app->bind(BookListServiceInterface::class, BookListService::class);
        $this->app->bind(ImportServiceInterface::class, ImportService::class);
        $this->app->bind(MonitoringServiceInterface::class, MonitoringService::class);
        $this->app->bind( ExternalSourceRepositoryInterface::class, ExternalSourceRepository::class);
        $this->app->bind( UserUpdateServiceInterface::class, UserUpdateService::class);
        $this->app->bind( FileServiceInterface::class, FileService::class);
        $this->app->bind( UserPhotoUpdateServiceInterface::class, UserPhotoUpdateService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
