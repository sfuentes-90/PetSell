<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembresiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membresias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creadaPor');
            $table->integer('cant_meses');
            $table->integer('precio');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creadaPor')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membresias');
    }
}
