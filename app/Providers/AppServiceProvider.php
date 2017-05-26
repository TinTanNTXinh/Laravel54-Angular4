<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Transport
        $this->app->bind(
            'App\Repositories\TransportRepositoryInterface',
            'App\Repositories\Eloquent\TransportEloquentRepository'
        );

        // Position
        $this->app->bind(
            'App\Repositories\PositionRepositoryInterface',
            'App\Repositories\Eloquent\PositionEloquentRepository'
        );

        // User
        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserEloquentRepository'
        );
    }
}
