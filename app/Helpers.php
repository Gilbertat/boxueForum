<?php

function navActiveView($anchor) {
    return Route::currentRouteName() == $anchor ? 'active' : '';
}

function get_user_static_domain()
{
    return config('app.user_static') ?: config('app.url');
}

function cdn($filePath)
{
    return config('app.url') . $filePath;
}

function slug($time, $user_id)
{
    return env('APP_URL') . 'topics/' . $user_id . '/' . $time;
}