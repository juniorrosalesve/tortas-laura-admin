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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('costo');
            $table->double('precio');
            $table->integer('cantidad');
            $table->unsignedBigInteger('categoriaId');
            $table->foreign('categoriaId')->references('id')->on('categorias');
            $table->integer('despachoId');
            $table->unsignedBigInteger('proveedorId');
            $table->foreign('proveedorId')->references('id')->on('proveedores');
            $table->boolean('produccion')->default(false);
            $table->boolean('inLocal')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
