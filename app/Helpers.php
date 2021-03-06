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

function show ($status, $message, $data=[], $httpCode=200)
{
    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];

    return response()->json($data, $httpCode);
}

function slug($time, $user_id)
{
    return env('APP_URL') . 'topics/' . $user_id . '/' . $time;
}

function cacheKey($user_id, $date)
{
    $slug = \Carbon\Carbon::parse($date)->timestamp;

    return 'topic:cache:' . $user_id . ':' . $slug;
}

function spaCacheKey($ip, $id)
{
    return 'topic:' . $ip . ':id:' . $id;
}
