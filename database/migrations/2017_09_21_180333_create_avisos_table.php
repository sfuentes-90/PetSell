<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avisos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idUsuario');
            $table->string('titulo');
            $table->longText('descripcion');
            $table->integer('precio');
            $table->boolean('activo');
            $table->string('region')->nulable();
            $table->unsignedInteger('ventas')->default(0);
            $table->longText('comentario');
            $table->unsignedInteger('idCategoria');
            $table->unsignedInteger('activadoPor');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idCategoria')->references('id')->on('categorias');
            $table->foreign('activadoPor')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avisos');
    }
}
