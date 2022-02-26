<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ISBN');
            $table->string('imagen')->nullable();
            $table->string('nombre', 150);
            $table->string('autor', 100);
            $table->string('editorial', 100);
            $table->integer('numEjemplaresDisp');
            $table->unsignedBigInteger('categoriaId')->nullable();
            $table->timestamps();

            //Foreign key declaration
            $table->foreign('categoriaId')
                ->references('id')
                ->on('categorias')
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
        Schema::dropIfExists('categorias');
    }
}
