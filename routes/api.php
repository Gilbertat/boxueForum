<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');




Route::resource('topics', 'TopicsController');
Route::get('users/{id}', 'UsersController@show');
