<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvInfo extends Model
{
    use HasFactory;

    protected $fillable     =   [
        'route',
        'type',
        'showIn'
    ];
}
