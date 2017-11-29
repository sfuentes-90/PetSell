<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idMembresia');
            $table->unsignedInteger('idUsuario');
            $table->boolean('activada');
            $table->unsignedInteger('activadaPor');
            $table->string('comprobante');
            $table->string('comentario')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idMembresia')->references('id')->on('membresias');
            $table->foreign('activadaPor')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial');
    }
}
