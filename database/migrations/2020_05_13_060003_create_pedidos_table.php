<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->text('descripcion');
            $table->text('caracteristicas')->nullable();///separamos popiedad----valor;;propiedad2----valor2;;etc....
            
            $table->double('precio')->default(0.0);
            $table->double('iva')->default(0.0);
            $table->double('envio')->default(0.0);
            
            $table->integer('cantidad')->default(0);
            $table->integer('producto_id')->default(0);

            $table->boolean('oferta')->default(false);
            $table->string('portada')->nullable();
            $table->string('imagen_oferta')->nullable();

            
            $table->string('categoria');
            $table->string('subcategoria')->nullable();
            $table->string('marca')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            
            $table->boolean('pagado')->default(false);
            $table->boolean('entregado')->default(false);
            $table->text('destino')->nullable();//a donde enviar el pedido
            $table->boolean('efectivo')->default(false);//comprobar si se ha efectuado el pago en efectivo
            $table->enum('tipo_pago',['efectivo','tarjeta'])->nullable();

            
            $table->integer('compra_id')->default(0);

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
        Schema::dropIfExists('pedidos');
    }
}
