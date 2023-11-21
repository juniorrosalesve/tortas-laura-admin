<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empleados  =   [
            "nombre" => "Gleidy Diana Pulido Ramos",
            "cedula" => "27834052",
            "telefono" => "0424-5589375",
            "correo" => "gleidydianapulido@gmail.com",
            "direccion" => "Ciudad Varyna",
            "cargo" => "Gerente",
        ];
        Empleado::create($empleados);
    }
}