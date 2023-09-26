<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function lista() {
        return view('proveedores.lista', [
            'proveedores' => Proveedor::orderBy('nombre', 'asc')->get()
        ]);
    }

    public function store(Request $r) {
        Proveedor::create($r->except('_token'));
        return '<script>alert("Añadido correctamente!");location.href="'.route('proveedores').'"</script>';
    }
}
