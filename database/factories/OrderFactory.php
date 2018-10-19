<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id'=> rand(1,3),
        'name'=> str_random(6)
    ];
});
