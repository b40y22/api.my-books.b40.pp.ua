<?php

namespace App\Providers;

use App\Src\Repositories\Eloquent\UserRepository;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot()
    {
        //
    }
}
