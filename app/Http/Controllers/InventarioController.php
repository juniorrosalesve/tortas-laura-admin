<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\MateriaPrima;
use App\Models\InventarioMaterial;

class InventarioController extends Controller
{
    public function lista() {
        return view('inventario.lista', [
            'proveedores' => Proveedor::orderBy('nombre', 'asc')->get(),
            'categorias' => Categoria::orderBy('nombre', 'asc')->get(),
            'productos' => Inventario::all(),
            'materias_primas' => MateriaPrima::all()
        ]);
    }

    public function store(Request $r) {
        if($r->ingresaPor == 'Proveedor') {
            Inventario::create($r->except([
                '_token',
                'ingresaPor',
                'materiaPrima',
                'materiaPrimaCantidad'
            ]));
        }
        else {
            $data   =   $r->except([
                '_token',
                'ingresaPor',
                'materiaPrima',
                'materiaPrimaCantidad'
            ]);

            $data['costo']  =   0;
            for($i = 0; $i < sizeof($r->materiaPrimaCosto); $i++) 
                $data['costo']  +=  ($r->materiaPrimaCosto[$i]*$r->materiaPrimaCantidad[$i]);
            
            $inventario     =   Inventario::create($data);
            for($i = 0; $i < sizeof($r->materiaPrima); $i++) {
                $mt     =   MateriaPrima::find($r->materiaPrima[$i]);
                MateriaPrima::where('id', $r->materiaPrima[$i])->update([
                    'cantidad' => ($mt->cantidad-$r->materiaPrimaCantidad[$i])
                ]);
                InventarioMaterial::create([
                    'materiaId' => $r->materiaPrima[$i],
                    'inventarioId' => $inventario->id,
                    'cantidad' => $r->materiaPrimaCantidad[$i]
                ]);
            }
        }
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
