<?php

/**
 * Application routes.
 */
Route::get('/', function () {
    $var = rand();
    return view('pages.welcome');
});
