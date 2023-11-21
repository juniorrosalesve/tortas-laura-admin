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
                'materiaPrimaCantidad',
                'inLocal'
            ]));
        }
        else {
            // dd($r->all());
            $data   =   $r->except([
                '_token',
                'ingresaPor',
                'materiaPrima',
                'materiaPrimaCantidad'
            ]);
            $data['produccion']     =   true;
            $data['costo']  =   0;
            $inventario     =   Inventario::create($data);
            $total  =   0;
            for($i = 0; $i < sizeof($r->materiaPrima); $i++) {
                if($r->inLocal == 0) {
                    $mt     =   MateriaPrima::find($r->materiaPrima[$i]);
                    MateriaPrima::where('id', $r->materiaPrima[$i])->update([
                        'cantidad' => ($mt->cantidad-$r->materiaPrimaCantidad[$i])
                    ]);
                }
                InventarioMaterial::create([
                    'materiaId' => $r->materiaPrima[$i],
                    'inventarioId' => $inventario->id,
                    'cantidad' => $r->materiaPrimaCantidad[$i]
                ]);
                $total  +=  ($r->materiaPrimaCosto[$i]*$r->materiaPrimaCantidad[$i]);
            }
            Inventario::where('id', $inventario->id)->update([
                'costo' => $total
            ]);
        }
        return '<script>alert("Añadido correctamente!");location.href="'.route('inventario').'"</script>';
    }


    /* API Rest */
    public function api_lista() {
        $categorias     =   Categoria::orderBy('nombre', 'asc')->get();
        for($i = 0; $i < sizeof($categorias); $i++) {
            $categorias[$i]['productos']  =   $categorias[$i]->productos;
            for($x = 0; $x < sizeof($categorias[$i]['productos']); $x++)
            {
                $producto   =   $categorias[$i]['productos'][$x];
                $categorias[$i]['canExtra']  =   false;
                if($categorias[$i]->nombre == 'Adicionales')
                    continue;
                if($producto->produccion == true && $producto->inLocal == true) {
                    $categorias[$i]['canExtra']     =   true;

                    $getMateriales  =   InventarioMaterial::where('inventarioId', $producto->id)->get();
                    $materiales     =   [];
                    for($z = 0; $z < sizeof($getMateriales); $z++)
                        $materiales[]   =   $getMateriales[$z]->materia->nombre;
                    $categorias[$i]['productos'][$x]['materiales']  =   $materiales;
                }
            }
        }
        return json_encode($categorias);
    }
}