<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'nombre' => 'Tortas de Laura, C.A',
            'rif' => 'J-50199001-8',
            'telefono' => '0424-5472564',
            'direccion' => 'Alto Barinas'
        ]);
    }
}
