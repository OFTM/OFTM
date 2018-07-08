<?php

use Faker\Generator as Faker;

$factory->define(App\fencer::class, function (Faker $faker) {
    return [
        'people_id' => factory(App\people::class, 1)->create()->first()->id,
    ];
});
