<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codLibro');
            $table->unsignedBigInteger('idUsuario');
            $table->timestamps();
            $table->date('fechaSacado');
            $table->date('fechaDevolucion')->nullable();
            $table->date('fechaEsperada');

            //Foreign key declaration
            $table->foreign('codLibro')
                ->references('id')
                ->on('libros');

            $table->foreign('idUsuario')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
