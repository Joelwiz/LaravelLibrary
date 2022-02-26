<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idusuario')->nullable();
            $table->unsignedBigInteger('codLibro')->nullable();
            $table->unsignedBigInteger('idPrestamo')->nullable();
            $table->string('observacion');
            $table->string('finPenalizacion');
            $table->timestamps();


            //Foreign key declaration
            $table->foreign('codLibro')
                ->references('id')
                ->on('libros')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('idusuario')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('idPrestamo')
                ->references('id')
                ->on('prestamos')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanciones');
    }
}
