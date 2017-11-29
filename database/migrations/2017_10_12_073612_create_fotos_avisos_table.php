<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosAvisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_avisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAviso')->unsigned();
            $table->string('filename');
            $table->timestamps();

            $table->foreign('idAviso')->references('id')->on('avisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos_avisos');
    }
}
