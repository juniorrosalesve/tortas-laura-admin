<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoIncrementPedido extends Model
{
    use HasFactory;

    protected $fillable     =   [
        'from_app'
    ];
}
