<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\TvController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('productos')->group(function() {
    Route::get('/', [InventarioController::class, 'api_lista']);
});

Route::prefix('ventas')->group(function() {
    Route::post('agregar', [VentaController::class, 'generate_venta']);
    Route::get('agregar-pedido', [VentaController::class, 'addPedido']);
});


/* TV Images o Videos */
Route::post('get-tv', [TvController::class, 'getTv']);
Route::get('test', [TvController::class, 'vepideTest']);


Route::prefix("produccion")->group(function() {
    Route::get('proveedores', [ProveedorController::class, 'api_getAll']);
});

Route::prefix("empleados")->group(function() {
    Route::post('/auth-ci', [EmpleadoController::class, 'authCi']);
});