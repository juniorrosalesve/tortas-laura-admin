<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::prefix('proveedores')->group(function() {
        Route::get('/', [ProveedorController::class, 'lista'])->name('proveedores');

        Route::post('store', [ProveedorController::class, 'store'])->name('store-proveedor');
    });

    Route::prefix('materias-primas')->group(function() {
        Route::get('/', [MateriaPrimaController::class, 'index'])->name('materias-primas');

        Route::post('store', [MateriaPrimaController::class, 'store'])->name('store-materia-prima');
    });
    
    Route::prefix('inventario')->group(function() {
        Route::get('/', [InventarioController::class, 'lista'])->name('inventario');

        Route::post('store', [InventarioController::class, 'store'])->name('store-producto');

        Route::prefix('categorias')->group(function() {
            Route::get('/', [CategoriaController::class, 'lista'])->name('categorias');

            Route::post('store', [CategoriaController::class, 'store'])->name('store-categoria');
        });
    });

    Route::prefix('ventas')->group(function() {
        Route::get('/', [VentaController::class, 'index'])->name('ventas');
        Route::get('tasa-dolar', [VentaController::class, 'tasas'])->name('tasas');

        Route::post('tasa-dolar-create', [VentaController::class, 'store_tasa'])->name('store-tasa');
    });

    Route::prefix('empleados')->group(function() {
        Route::get('/', [EmpleadoController::class, 'index'])->name('empleados');

        Route::post('store', [EmpleadoController::class, 'store'])->name('store-empleado');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
