<?php

use App\Academico;
use Illuminate\Database\Seeder;

class AcademicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Academico::create([
            'user_id'  => 1,
            'titulo'   => 'Titulo ejemplo',
            'yini' => 2000,
            'yfin' => 2015,
            'nivel_id' => 3,
            'name_file' => 'archivoPDF',
            'documento' => 'fawefafwefaws',
            'verificado' => true
        ]);

        Factory(Academico::class, 15)->create();
    }
}
