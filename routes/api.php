<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\TvController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('productos')->group(function() {
    Route::get('/', [InventarioController::class, 'api_lista']);
});

Route::post('nueva-venta', [VentaController::class, 'generate_venta']);


/* TV Images o Videos */
Route::post('get-tv', [TvController::class, 'getTv']);