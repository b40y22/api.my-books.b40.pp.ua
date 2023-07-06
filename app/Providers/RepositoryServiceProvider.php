<?php

namespace App\Providers;

use App\Src\Repositories\Eloquent\AuthorRepository;
use App\Src\Repositories\Eloquent\BookRepository;
use App\Src\Repositories\Eloquent\UserRepository;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    public function boot()
    {
        //
    }
}
