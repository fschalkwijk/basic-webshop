<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Cart;

class CartServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Cart::class, function($app){
            return new Cart;
        });
    }

    public function provides(){
        return [Cart::class];
    }
}
