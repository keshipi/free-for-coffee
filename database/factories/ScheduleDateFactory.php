<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\ScheduleDate::class, function (Faker $faker) {
    return [
        'user_id' => $faker->name,
        'date' => date('Y-m-d', strtotime('+1 day')),
    ];
});
