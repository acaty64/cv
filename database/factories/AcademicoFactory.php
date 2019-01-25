<?php

use Faker\Generator as Faker;
use Faker\Provider\DateTime;

$factory->define(App\Academico::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'titulo' => $faker->sentence,
        // 'descripcion' => $faker->text,
        'nivel_id' => rand(1,5),
        'yini' => intval($faker->year($max = 'now')),
        'yfin' => intval($faker->year($max = 'now')),

    ];
});
