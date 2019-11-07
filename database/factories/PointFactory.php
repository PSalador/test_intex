<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Point;
use Grimzy\LaravelMysqlSpatial\Types\Point as TypePoint;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Point::class, function (Faker $faker) {
    return [
        'latlng' => new TypePoint($faker->latitude(55.65, 55.85), $faker->longitude(37.40, 37.80)),
        'comment' => $faker->sentence(6,true),
    ];
});
