<?php

use App\Nivel;
use Illuminate\Database\Seeder;

class NivelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nivel::create([
                'nivel' => 1,
                'wnivel'=> 'Bachiller'
            ]);
        Nivel::create([
                'nivel' => 2,
                'wnivel'=> 'Titulo Profesional'
            ]);
        Nivel::create([
                'nivel' => 3,
                'wnivel'=> 'Maestro'
            ]);
        Nivel::create([
                'nivel' => 4,
                'wnivel'=> 'Doctor'
            ]);
        Nivel::create([
                'nivel' => 5,
                'wnivel'=> 'Segunda Especialidad'
            ]);
        Nivel::create([
                'nivel' => 1,
                'wnivel'=> 'Basico'
            ]);
        Nivel::create([
                'nivel' => 2,
                'wnivel'=> 'Intermedio'
            ]);
    	Nivel::create([
                'nivel' => 3,
                'wnivel'=> 'Avanzado'
            ]);
    }
}
