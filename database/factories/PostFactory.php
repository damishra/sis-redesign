<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'course_id' => rand(100000,999999),
        'title' => str_random(10),
        'description' => $faker->text(),
    ];
});
