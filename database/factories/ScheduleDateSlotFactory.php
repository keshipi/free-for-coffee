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

$factory->define(App\ScheduleDateSlot::class, function (Faker $faker) {
    $slots = array('10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00');
    return [
        'slot' => $faker->randomElement($slots),
    ];
});
