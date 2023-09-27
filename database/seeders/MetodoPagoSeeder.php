<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MetodoPago;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodosPagos   =   [
            'Efectivo $',
            'Efectivo VES',
            'Pago Móvil',
            'Binance',
            'Zelle',
            'Zinli',
            'Otros'
        ];
        for($i = 0; $i < sizeof($metodosPagos); $i++)
            MetodoPago::create([
                'nombre' => $metodosPagos[$i]
            ]);
    }
}
