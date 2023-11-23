<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;

    protected $fillable     =   [
        'nombre',
        'costo',
        'precio',
        'cantidad',
        'unidad',
        'presentacion',
        'proveedorId'
    ];
}
