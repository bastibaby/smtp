<?php

/*----------------------------------------------------*/
// Directory separator
/*----------------------------------------------------*/
defined('DS') ? DS : define('DS', DIRECTORY_SEPARATOR);

/*----------------------------------------------------*/
// Application paths
/*----------------------------------------------------*/
defined('THEMOSIS_PUBLIC_DIR') ? THEMOSIS_PUBLIC_DIR : define('THEMOSIS_PUBLIC_DIR', 'htdocs');
defined('THEMOSIS_ROOT') ? THEMOSIS_ROOT : define('THEMOSIS_ROOT', realpath(__DIR__ . '/../'));
defined('CONTENT_DIR') ? CONTENT_DIR : define('CONTENT_DIR', 'content');
defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR : define('WP_CONTENT_DIR', realpath(THEMOSIS_ROOT . DS . THEMOSIS_PUBLIC_DIR . DS . CONTENT_DIR));
/*----------------------------------------------------*/
// Composer autoload
/*----------------------------------------------------*/
if (file_exists($autoload = THEMOSIS_ROOT . '/vendor/autoload.php')) {
    require $autoload;
}

$app = require __DIR__ . '/../bootstrap/app.php';
if ($app === true) {
    $app = app();
}
/*
|--------------------------------------------------------------------------
| Start the application
|--------------------------------------------------------------------------
|
| We're going to initialize the kernel instance and capture the current
| request. We won't directly manage a response from the current file.
| We let WordPress bootstrap its stuff and we'll manage the response
| once WordPress is fully loaded.
|
*/
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->init(
    Illuminate\Http\Request::capture()
);

/*----------------------------------------------------*/
// Database prefix (WordPress)
/*----------------------------------------------------*/
$table_prefix = config('database.connections.mysql.prefix', 'wp_');

/* That's all, stop editing! Happy blogging. */
require_once ABSPATH . '/wp-settings.php';
