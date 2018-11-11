<?php

namespace App\Providers;

use Encore\Admin\Config\Config;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('datetime', function($expression) {
            return "<?php echo $expression; ?>";
        });

        View::share('username', 'sw');

        Config::load();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
