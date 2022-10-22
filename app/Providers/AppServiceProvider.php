<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        /*
        To enable Pagination with Bootstrap styling, do the following steps:
        -   in the terminal, run this command: php artisan vendor:publish
        -   check the list, find the index of 'laravel-pagination' and enter in the terminal
        -   go in AppServiceProvider and apply this line of code: Paginator::useBootstrap();  [Import Class: use Illuminate\Pagination\Paginator]
    */
    }
}
