<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telfijo')->nullable();
            $table->string('telcelular');
            $table->date('fechanacimiento');
            $table->string('domicilio')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('puntos')->nullable()->default(0);
            $table->string("qr")->nullable();

            $table->unsignedBigInteger('ciudade_id')->nullable();
            $table->foreign('ciudade_id')->references('id')->on('ciudades')->onDelete('set null');

            $table->boolean('habilitado')->default(true);
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
        Schema::dropIfExists('clientes');
    }
};
