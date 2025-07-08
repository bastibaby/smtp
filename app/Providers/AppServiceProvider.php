<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Comentamos o eliminamos estas líneas
        // require __DIR__ . '/../../vendor/autoload.php';
        // $app = require_once __DIR__ . '/../../bootstrap/app.php';

        // Puedes cargar wp-load.php solo si es estrictamente necesario y con control
        // require_once web_path('cms/wp-load.php');
    }

    public function register()
    {
        //
    }
}
