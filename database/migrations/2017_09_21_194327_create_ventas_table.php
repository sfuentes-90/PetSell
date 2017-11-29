<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idVendedor');
            $table->unsignedInteger('idComprador');
            $table->unsignedInteger('idAviso');
            $table->datetime('fechaCompra');
            $table->boolean('valorada');
            $table->string('comprobante');
            $table->string('direccion_envio')->nullable();
            $table->string('comentario_comprador')->nullable();
            $table->boolean('comprobante_valido');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idComprador')->references('id')->on('users');
            $table->foreign('idVendedor')->references('id')->on('users');
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
        Schema::dropIfExists('ventas');
    }
}
