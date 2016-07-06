<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Database;

class DatabaseServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\DatabaseContract',function(){
            return new Database();
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\Contracts\DatabaseContract'];
    }




}
