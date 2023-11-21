<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\SalidaProducto;
use App\Models\TasaDolar;
use App\Models\AutoIncrementPedido;

class VentaController extends Controller
{

    public function index() {
        return view('ventas.lista', [
            'ventas' => Venta::all()
        ]);
    }
    public function tasas() {
        return view('ventas.tasas', [
            'tasas' => TasaDolar::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store_tasa(Request $r) {
        TasaDolar::create($r->except('_token'));
        return '<script>alert("Añadido correctamente!");location.href="'.route('tasas').'"</script>'; 
    }

    /* API JSON */
    public function addPedido(Request $r){
        $generateId     =   AutoIncrementPedido::create(['from_app' => true]);
        return $generateId->id;
    }

    public function generate_venta(Request $r) {
        $venta  =   Venta::create([
            'empleadoId' => $r->empleadoId,
            'mesa' => $r->mesa,
            'numeroPedidoLocal' => $r->numeroPedidoLocal,
            'tasa' => 33.99
        ]);
        $productos  =   json_decode($r->productos, true);
        for($i = 0; $i < sizeof($productos); $i++) {
            SalidaProducto::create([
                'ventaId' => $venta->id,
                'nombre' => $productos[$i]['nombre'],
                'precio' => $productos[$i]['precio'],
                'cantidad' => $productos[$i]['cantidad'],
            ]);
        }
        return 1;
    }
}
