<?php

use Faker\Generator as Faker;

$factory->define(App\combat::class, function (Faker $faker) {
    $t = App\tournament::all()->random(1)->first->get()->id;
    return [
        'participant1_id' => App\participant::all()->where('tournament_id', $t)->random(1)->first->id,
        'participant2_id' => App\participant::all()->where('tournament_id', $t)->random(1)->first->id,
        'tournament_id' => $t,
        'referee_id' => App\referee::all()->random(1)->first->id,
        'hits1' => $faker->numberBetween(0,20),
        'hits2' => $faker->numberBetween(0,20)
    ];
});
