<?php

namespace App\Providers;

use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Resources\Json\JsonResource;
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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
        JsonResource::withoutWrapping();

        Validator::extend('filter', function ($attribute,$value,$paramters){
       return !in_array(strtolower($value),$paramters);

        },  "this name is not allowed tody for test");

        Paginator::useBootstrapFive();
        // Paginator::useTailwind();

        // Paginator::defaultView();
    }
}
