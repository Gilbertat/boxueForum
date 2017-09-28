<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');

Route::resource('topics', 'TopicsController');
Route::post('topics/image/uploads', 'TopicsController@attachment');
Route::post('topics/store', 'TopicsController@store');
Route::post('replies/store', 'RepliesController@store');
Route::delete('replies/delete/{reply}', 'RepliesController@delete');

Route::get('users/{id}', 'UsersController@show');

Route::get('test', function() {
    $origin = \App\Models\Topic::query()->with(['user' => function ($query) {
        $query->select('id', 'name');
    }])->where('is_hidden',1)
        ->orderBy('updated_at', 'desc')
        ->get();

    return ['origin' => $origin];
});
