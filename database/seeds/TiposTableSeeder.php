<?php

use App\Tipo;
use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['tipo' => 'Academico']);
        Tipo::create(['tipo' => 'Laboral']);
        Tipo::create(['tipo' => 'Idioma']);
        Tipo::create(['tipo' => 'Publicacion']);
        Tipo::create(['tipo' => 'Informatica']);
    	Tipo::create(['tipo' => 'Otro']);
    }
}
