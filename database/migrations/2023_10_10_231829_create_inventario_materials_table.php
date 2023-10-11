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
        Schema::create('inventario_materiales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materiaId');
            $table->foreign('materiaId')->references('id')->on('materia_primas');
            $table->unsignedBigInteger('inventarioId');
            $table->foreign('inventarioId')->references('id')->on('inventarios');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_materiales');
    }
};
