<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
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
     */
    public function boot(): void
    {

        Validator::extend('filter', function ($attribute,$value,$paramters){
       return !in_array(strtolower($value),$paramters);

        },  "this name is not allowed tody for test");

        Paginator::useBootstrapFive();
        // Paginator::useTailwind();

        // Paginator::defaultView();
    }
}
