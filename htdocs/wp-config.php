<?php

// Directory separator
defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);

// Application paths
defined('THEMOSIS_PUBLIC_DIR') ?: define('THEMOSIS_PUBLIC_DIR', 'htdocs');
defined('THEMOSIS_ROOT') ?: define('THEMOSIS_ROOT', realpath(__DIR__ . '/../'));
defined('CONTENT_DIR') ?: define('CONTENT_DIR', 'content');
defined('WP_CONTENT_DIR') ?: define('WP_CONTENT_DIR', realpath(THEMOSIS_ROOT . DS . THEMOSIS_PUBLIC_DIR . DS . CONTENT_DIR));

// Composer autoload
if (file_exists($autoload = THEMOSIS_ROOT . '/vendor/autoload.php')) {
    require $autoload;
}

// Only initialize Laravel when NOT accessing WordPress (like /cms/*)
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$isWordPressRequest = str_starts_with($requestUri, '/cms');

if (!$isWordPressRequest) {
    $app = require __DIR__ . '/../bootstrap/app.php';
    if ($app === true) {
        $app = app();
    }

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $kernel->init(
        Illuminate\Http\Request::capture()
    );
}

// WordPress URLs
if (!defined('WP_HOME')) {
    define('WP_HOME', 'https://themosis3-0.fly.dev');
}
if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', 'https://themosis3-0.fly.dev/cms');
}
define('WP_CONTENT_URL', WP_HOME . '/' . CONTENT_DIR);

// Database
define('DB_NAME', getenv('DB_DATABASE'));
define('DB_USER', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST') . ':' . getenv('DB_PORT'));
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Table prefix
$table_prefix = 'wp_';

// Salts (puedes usar los reales o dejar así si ya están definidos en otro lado)
define('AUTH_KEY', getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
define('NONCE_KEY', getenv('NONCE_KEY'));
define('AUTH_SALT', getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT'));
define('NONCE_SALT', getenv('NONCE_SALT'));

// Debug
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Other options
define('DISALLOW_FILE_EDIT', true);
define('WP_AUTO_UPDATE_CORE', false);
define('WP_DEFAULT_THEME', 'meat-theme');

// Load WordPress
require_once ABSPATH . '/wp-settings.php';
