<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//string
use Illuminate\support\Facades\Schema;

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
        //string
        Schema::defaultStringLength(191);
    }
}
