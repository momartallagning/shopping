<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Cart;
use Illuminate\Support\Facades\Route;
use App\Models\Shop;

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
        View::composer(['layouts.app', 'products.show'], function ($view) {
            $view->with([
                'cartCount' => Cart::getTotalQuantity(), 
                'cartTotal' => Cart::getTotal(),
            ]);
        });

        Route::resourceVerbs([
            'edit' => 'modification',
            'create' => 'creation',
        ]);

        View::share('shop', Shop::firstOrFail());
    }
}
