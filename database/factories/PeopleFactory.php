<?php

use Faker\Generator as Faker;

$factory->define(App\people::class, function (Faker $faker) {
    return [
        'surname' => $faker->lastName,
        'forename' => $faker->firstName,
        'birthdate' => $faker->date(),
        'sex_id' => App\sex::all()->random(1)->first->id,
    ];
});
