<?php

use Faker\Generator as Faker;

$factory->define(App\tournament::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'ruleset_id' => App\ruleset::all()->random(1)->first->id,
        'weaponclass_id' => App\weaponclass::all()->random(1)->first->id,
        'ageclass_id' => App\ageclass::all()->random(1)->first->id,
        'sex_id' => App\sex::all()->random(1)->first->id
    ];
});
