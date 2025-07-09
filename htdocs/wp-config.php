<?php

/*----------------------------------------------------*/
// Directory separator
/*----------------------------------------------------*/
defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);

/*----------------------------------------------------*/
// Application paths
/*----------------------------------------------------*/
defined('THEMOSIS_PUBLIC_DIR') ?: define('THEMOSIS_PUBLIC_DIR', 'htdocs');
defined('THEMOSIS_ROOT') ?: define('THEMOSIS_ROOT', realpath(__DIR__ . '/../'));
defined('CONTENT_DIR') ?: define('CONTENT_DIR', 'content');
defined('WP_CONTENT_DIR') ?: define('WP_CONTENT_DIR', realpath(THEMOSIS_ROOT . DS . THEMOSIS_PUBLIC_DIR . DS . CONTENT_DIR));

/*----------------------------------------------------*/
// Composer autoload
/*----------------------------------------------------*/
if (file_exists($autoload = THEMOSIS_ROOT . '/vendor/autoload.php')) {
    require $autoload;
}

/*----------------------------------------------------*/
// Laravel Kernel only outside /cms (WordPress)
// Prevent interference with wp-login.php and wp-admin
/*----------------------------------------------------*/
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
if (!str_starts_with($requestUri, '/cms')) {
    $app = require __DIR__ . '/../bootstrap/app.php';
    if ($app === true) {
        $app = app();
    }

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $kernel->init(
        Illuminate\Http\Request::capture()
    );
}

/*----------------------------------------------------*/
// Force WP URLs
/*----------------------------------------------------*/
if (!defined('WP_HOME')) {
    define('WP_HOME', 'https://themosis3-0.fly.dev');
}
if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', 'https://themosis3-0.fly.dev/cms');
}

/*----------------------------------------------------*/
// Database prefix (WordPress)
/*----------------------------------------------------*/
$table_prefix = config('database.connections.mysql.prefix', 'wp_');

/*----------------------------------------------------*/
// That's all, stop editing! Happy blogging.
/*----------------------------------------------------*/
require_once ABSPATH . '/wp-settings.php';
