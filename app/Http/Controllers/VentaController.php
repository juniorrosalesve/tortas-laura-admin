<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\SalidaProducto;

class VentaController extends Controller
{

    public function index() {
        return view('ventas.lista', [
            'ventas' => Venta::all()
        ]);
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
