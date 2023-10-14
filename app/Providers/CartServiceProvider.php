<?php

namespace App\Providers;

use App\Repositories\Cart\CartModelRepository  ;
use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider 
{
    // public $bindings = [
    //     CartRepository::class => CartModelRepository::class,
    // ];
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class,function($app){
            return new  CartModelRepository();
        } );
        
        // $this->app->bind('cart',  CartModelRepository::class );

        // $this->app->singleton('cart',  function (){
        //     return  CartModelRepository::class;
        // });
        
    //     $this->app->bind(CartRepository::class,function(Application $app){
    //         return new CartRepository($app->make(CartModelRepository::class));
    //     } );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
