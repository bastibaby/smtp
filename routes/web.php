<?php

/**
 * Application routes.
 */
Route::get('/', function () {
    $var = rand();

    return view('welcome');
});
