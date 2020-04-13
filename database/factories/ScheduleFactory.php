<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'location' => 'Bordeaux',
        'begin_at' => Carbon::now(),
        'end_at' => Carbon::now(),
        'date' => Carbon::now()
    ];
});
