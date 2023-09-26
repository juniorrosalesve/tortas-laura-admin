<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Categoria;

class InventarioController extends Controller
{
    public function lista() {
        return view('inventario.lista', [
            'proveedores' => Proveedor::orderBy('nombre', 'asc')->get(),
            'categorias' => Categoria::orderBy('nombre', 'asc')->get(),
            'productos' => Inventario::all()
        ]);
    }

    public function store(Request $r) {
        Inventario::create($r->except('_token'));
        return '<script>alert("Añadido correctamente!");location.href="'.route('inventario').'"</script>';
    }


    /* API Rest */
    public function api_lista() {
        $categorias     =   Categoria::orderBy('nombre', 'asc')->get();
        for($i = 0; $i < sizeof($categorias); $i++)
            $categorias[$i]['productos']  =   $categorias[$i]->productos;
        return json_encode($categorias);
    }
}
