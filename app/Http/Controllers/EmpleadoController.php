<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\TasaDolar;

class EmpleadoController extends Controller
{
    public function index() {
        return view('empleados.lista', [
            'empleados' => Empleado::all()
        ]);
    }

    public function store(Request $r) {
        Empleado::create($r->except('_token'));

        return '<script>alert("Añadido correctamente!");location.href="'.route('empleados').'"</script>';
    }


    /* API Json */
    public function authCi(Request $r) {
        $empleado       =   Empleado::where('cedula', $r->cedula)->first();
        $dolarToday     =   TasaDolar::orderBy('created_at', 'desc')->first();

        $empleado['tasa']   =   $dolarToday->precio;
        $empleado['tasaId'] =   $dolarToday->id;

        return $empleado;
    }
}
