<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ColorRepository;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ColorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
         Paginator::useBootstrap();
    }
}
