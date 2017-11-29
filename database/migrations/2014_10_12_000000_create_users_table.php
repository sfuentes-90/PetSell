<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('rut')->unique();
            $table->string('cuenta')->default(0);
            $table->string('banco')->default('N/D');
            $table->string('telefono')->default('N/D');
            $table->date('expiracion_premium')->default(date('Y-m-d', 0));
            $table->string('password');
            $table->integer('valoraciones_positivas')->default(0);
            $table->integer('valoraciones_negativas')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
