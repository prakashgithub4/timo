<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class UserserviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Repositories\Interfaces\UserInterface', 'App\Repositories\UserRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
