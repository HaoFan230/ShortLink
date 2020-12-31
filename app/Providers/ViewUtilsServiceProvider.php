<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewUtilsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ViewUtilsService',function() {
            return new \App\Tools\ViewUtils();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
