<?php

use App\Nivel;
use App\NivelTipo;
use App\Tipo;
use Faker\Generator as Faker;

$factory->define(NivelTipo::class, function (Faker $faker) {
    return [
        'nivel_id' => Nivel::all()->random()->id,
        'tipo_id' => Tipo::all()->random()->id,
    ];
});
