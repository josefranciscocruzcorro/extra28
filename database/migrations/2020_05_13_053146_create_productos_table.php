<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->text('descripcion');
            $table->text('caracteristicas')->nullable();///separamos popiedad----valor;;propiedad2----valor2;;etc....
            
            $table->double('precio')->default(0.0);
            $table->double('iva')->default(0.0);
            $table->double('envio')->default(0.0);
            
            $table->integer('stock')->default(0);

            $table->boolean('oferta')->default(false);
            $table->boolean('visible')->default(true);
            $table->string('portada')->nullable();
            $table->string('imagen_oferta')->nullable();

            
            $table->string('categoria');
            $table->string('subcategoria')->nullable();
            $table->string('marca')->nullable();
            
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
        Schema::dropIfExists('productos');
    }
}
