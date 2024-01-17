<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        require __DIR__ . '/../../vendor/autoload.php';

        $app = require_once __DIR__ . '/../../bootstrap/app.php';

        require web_path('cms/wp-load.php');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
