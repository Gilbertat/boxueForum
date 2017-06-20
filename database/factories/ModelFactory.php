<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar' => 'default_avatar.jpg',
        'activated' => true,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});

$factory->define(App\Models\Topic::class, function (Faker\Generator $faker) {

     $date_time = $faker->date . ' ' . $faker->time;

     return [
         'title' => $faker->word,
         'content_raw' => $faker->text(),
         'content_html' => $faker->text(),
         'reply_count' => random_int(0, 100),
         'view_count' => random_int(0, 100),
         'created_at' => $date_time,
         'updated_at' => $date_time,
     ];
});

$factory->define(\App\Models\Post::class, function (Faker\Generator $faker) {
    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'content' => '欢迎来到泊学论坛!',
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
