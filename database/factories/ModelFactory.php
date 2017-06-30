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

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Artist::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'biography' => $faker->realText(),
        'birthday' => $faker->date(),
        'gender' => $faker->randomElement(['Male', 'Female']),
    ];
});
$factory->define(App\Models\Album::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'release_date' => $faker->date(),
    ];
});
$factory->define(App\Models\Song::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
    ];
});
