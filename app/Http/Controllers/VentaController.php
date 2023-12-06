<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Venta;
use App\Models\SalidaProducto;
use App\Models\TasaDolar;
use App\Models\AutoIncrementPedido;

class VentaController extends Controller
{

    public function index() {
        $response = Http::get('http://localhost:9999/');

        return view('ventas.lista', [
            'ventas' => $response->json()
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

    public function getVentas() {
        $url = "https://firestore.googleapis.com/v1/projects/tortas-de-laura/databases/(default)/pedidos";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ya29.a0AfB_byCHVYBfoPYhQsN93OotNEdpIJK8aSzb4ccpc5ZHlB1dl2M1a_oBwO-5JxxxHBdaq9hufhwin-MML2RdaL0BkhpxCl3mo8yRt8xL9ivJojgwl1-T8p05hrCRHCwV7GKblJMpT5jyxZ71SBiXJvCGD2ArvQfcNYXUaCgYKAaYSARMSFQHGX2MiVxV1z5lo29qCrrmbFhrOYw0171'
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true);

    }
}
