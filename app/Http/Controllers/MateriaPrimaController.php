<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MateriaPrima;
use App\Models\Proveedor;

class MateriaPrimaController extends Controller
{
    public function index() {
        return view('materia_prima.lista', [
            'proveedores' => Proveedor::all(),
            'materias_primas' => MateriaPrima::all()
        ]);
    }

    public function store(Request $r) {
        MateriaPrima::create($r->except('_token'));

        return '<script>alert("Añadido correctamente!");location.href="'.route('materias-primas').'"</script>';
    }
}
