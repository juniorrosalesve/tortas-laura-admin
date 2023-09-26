<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaProducto extends Model
{
    use HasFactory;

    protected $fillable     =   [
        'ventaId',
        'nombre',
        'precio',
        'cantidad',
        'productoId'
    ];
}
