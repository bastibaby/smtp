<?php
/**
 * themosis_path
 * themosis_assets
 * themosis_theme_assets
 */
function themosis_path($value=null){
    $theme = app('wp.theme');
    if($value =='theme'){
        return $theme->getPath();
    }
    return $theme;
}
function themosis_assets($path=null){
    $route = app('wp.theme')->getUrl('dist');
    return $path ? $route.$path : $route;
}
function themosis_theme_assets(){
    $route = app('wp.theme')->getUrl('dist');
    return $route;
}