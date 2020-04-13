<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
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

$factory->define(Event::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'event_name' => $faker->catchPhrase ,
        'description' => $faker->text($maxNbChars = 40),
        'start_at' => Carbon::now(),
        'end_at' => Carbon::now(),
    ];
});
