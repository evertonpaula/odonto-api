<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //User Service
        $this->app->bind('user.service', \App\Services\User\UserService::class);

        //User Repository
        $this->app->bind('user.repository', \App\Repositories\Eloquent\UserRepository::class);
    }
}
