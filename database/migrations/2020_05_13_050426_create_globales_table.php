<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('globales', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('icono')->nullable();
            $table->text('valor')->nullable();
            $table->string('color')->nullable();
            $table->string('url')->nullable();
            $table->boolean('visible')->default(true);
            $table->enum('posicion',['cabecera','pie','flotante','banner'])->default('pie');

            $table->enum('tipo',['general','terminos','politicas','pagina'])->default('general');

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
        Schema::dropIfExists('globales');
    }
}
