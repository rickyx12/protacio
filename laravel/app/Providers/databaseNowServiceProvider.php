<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\databaseNow;

class databaseNowServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Helpers\Contracts\databaseNowContract',function(){
           return new databaseNow();
        });
    }


    public function provides(){
        return ['App\Helpers\Contracts\databaseNowContract'];
    }

}
