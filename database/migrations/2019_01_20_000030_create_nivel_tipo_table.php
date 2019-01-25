<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_tipo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nivel_id')->unsigned();
            // $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->integer('tipo_id')->unsigned();
            // $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nivel_tipos');
    }
}
