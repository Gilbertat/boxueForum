<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');




Route::resource('topics', 'TopicsController');
Route::post('topics/image/uploads', 'TopicsController@attachment');
Route::post('topics/store', 'TopicsController@store');

Route::get('users/{id}', 'UsersController@show');
