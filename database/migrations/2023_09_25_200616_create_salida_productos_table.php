<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salida_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ventaId');
            $table->foreign('ventaid')->references('id')->on('ventas');
            $table->string('nombre');
            $table->double('precio');
            $table->integer('cantidad');
            $table->bigInteger('productoId')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salida_productos');
    }
};
