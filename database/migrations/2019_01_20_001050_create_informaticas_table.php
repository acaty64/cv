<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformaticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informaticas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('titulo');
            $table->mediumText('descripcion');
            $table->integer('nivel_id');
            $table->integer('yini');
            $table->integer('yfin')->nullable();
            $table->string('documento');
            $table->boolean('verificado')->default(false);
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
        Schema::dropIfExists('informaticas');
    }
}
