<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * we can add using php artisan vendor: publish
     * this creates the pagination template here :
     * resources/views/vendor/pagination
     * we can then update this layout of the pagination menu
     */

    public function boot()
    {
        Paginator::useBootstrapFour();
    }
}
