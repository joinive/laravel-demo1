<?php

namespace App\Providers;

use App\Helpers\RedisTool;
use Illuminate\Support\ServiceProvider;

class RedisToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('redistool',function() {
            return new RedisTool();
        });
    }
}
