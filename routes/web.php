<?php

/* index */
Route::get('/', 'StaticPagesController@home')->name('home');
//Route::get('/home', 'StaticPagesController@home')->name('home');

/* search */
Route::get('/search', 'StaticPagesController@search')->name('search');


/* Users Control */
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

Route::get('users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::get('users/{id}', 'UsersController@show')->name('users.show');
Route::patch('users/{id}', 'UsersController@update')->name('users.update');
Route::get('/users/{id}/edit_password', 'UsersController@editPassword')->name('users.edit_password');
Route::patch('/users/{id}/update_password', 'UsersController@updatePassword')->name('users.update_password');
Route::get('/users/{id}/edit_avatar', 'UsersController@editAvatar')->name('users.edit_avatar');
Route::patch('/users/{id}/update_avatar', 'UsersController@updateAvatar')->name('users.update_avatar');
Route::get('/users/{id}/followers', 'UsersController@followers')->name('users.followers');
Route::get('/user/all', 'UsersController@all')->name('users.all');
Route::get('/hall_of_fame', 'UsersController@fame')->name('users.fame');


/* reset password */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

/* Users status */
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

/*categories*/
Route::get('categories/{id?}', 'CategoriesController@show')->name('categories.show');

/* topic */
Route::get('topic/create', 'TopicsController@create')->name('topic.create');
Route::post('topic', 'TopicsController@store')->name('topic.store');
Route::get('topics/{id}/{slug}', 'TopicsController@detail')->name('topic.detail');
Route::get('users/{id}/topics', 'UsersController@topic')->name('users.topics');
Route::post('topic/uploads/images/', 'TopicsController@attachment')->name('topic.attachment');
Route::get('topic/{id}/vote', 'TopicsController@vote')->name('topic.vote');
Route::delete('topic/{id}/delete', 'TopicsController@delete')->name('topic.delete');
Route::post('topic/{id}retry', 'TopicsController@retry')->name('topic.retry');
Route::get('topic/{id}/edit', 'TopicsController@edit')->name('topic.edit');
Route::post('topic/{id}/update', 'TopicsController@update')->name('topic.update');

/*follow unFollow*/
Route::post('/users/followers/{id}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{id}', 'FollowersController@destroy')->name('followers.destroy');

/* replies */

Route::post('/replies', 'RepliesController@store')->name('replies.store');
Route::post('replies{id}/delete','RepliesController@delete')->name('replies.delete');

/* notification */







Auth::routes();

