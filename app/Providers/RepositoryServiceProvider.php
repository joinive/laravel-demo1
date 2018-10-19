<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
//接口与实现类的两种绑定模式
        //单例模式（个人推荐）
        $this->app->singleton('App\Repositories\Contracts\UserInterface',function ($app){
            return new \App\Repositories\Eloquent\UserServiceRepository();
        });
//绑定
//        $this->app->bind('App\Repositories\Contracts\UserInterface','App\Repositories\Eloquent\UserServiceRepository');
    }
}
