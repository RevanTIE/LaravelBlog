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
     */
    public function boot(): void
    {
        //Descomentar cuando se tenga dominio configurado en AWS
        // if(config('app.env')=='production'){
        //     URL::forceScheme('https');
        // }
        Paginator::useBootstrapFour();
        
    }
}
