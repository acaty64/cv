<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(NivelTableSeeder::class);
        $this->call(NivelTipoTableSeeder::class);
        $this->call(AcademicosTableSeeder::class);
    }
}
