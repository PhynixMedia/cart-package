<?php

namespace Cart\App;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * 
     * @return void
     */
    public function register()
    {
        //register the view
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes/web.php';
        include __DIR__ . '/routes/api.php';

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /**
         * Register config and views
         */
        $this->mergeConfigFrom(__DIR__ . '/config/cart-app.php', 'cart-app');
        $this->publishes([
            __DIR__ . '/config/cart-app.php' => config_path('cart-app.php'),
            __DIR__ . '/views' => resource_path('views/vendor/cart/'),
        ]);

        //register the view
        $this->loadViewsFrom(resource_path('views/vendor/cart'), 'cart');
    }
}