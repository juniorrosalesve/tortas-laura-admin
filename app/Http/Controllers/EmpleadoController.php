<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empleado;

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
}
