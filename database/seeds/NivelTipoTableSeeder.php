<?php

use App\NivelTipo;
use Illuminate\Database\Seeder;

class NivelTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelTipo::create([
                'nivel_id' => 1,
                'tipo_id'=> 1
            ]);
        NivelTipo::create([
                'nivel_id' => 2,
                'tipo_id'=> 1
            ]);
        NivelTipo::create([
                'nivel_id' => 3,
                'tipo_id'=> 1
            ]);
        NivelTipo::create([
                'nivel_id' => 4,
                'tipo_id'=> 1
            ]);
        NivelTipo::create([
                'nivel_id' => 5,
                'tipo_id'=> 1
            ]);
        NivelTipo::create([
                'nivel_id' => 6,
                'tipo_id'=> 3
            ]);
        NivelTipo::create([
                'nivel_id' => 7,
                'tipo_id'=> 3
            ]);
        NivelTipo::create([
                'nivel_id' => 8,
                'tipo_id'=> 3
            ]);
        NivelTipo::create([
                'nivel_id' => 6,
                'tipo_id'=> 5
            ]);
        NivelTipo::create([
                'nivel_id' => 7,
                'tipo_id'=> 5
            ]);
    	NivelTipo::create([
                'nivel_id' => 8,
                'tipo_id'=> 5
            ]);
    }
}
