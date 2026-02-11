<?php

// Ensure we only include view paths that actually exist.
$view_paths = [
    resource_path('views'),
];

$custom_views_path = base_path('custom_views');
if (file_exists($custom_views_path) && is_dir($custom_views_path)) {
    // Prepend custom views so they take precedence when present
    array_unshift($view_paths, $custom_views_path);
}

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => $view_paths,

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];
