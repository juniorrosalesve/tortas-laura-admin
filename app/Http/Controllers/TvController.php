<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\TvInfo;

class TvController extends Controller
{
    public function getTv(Request $r) {
        $get    =   TvInfo::where('showIn', $r->tv)->first();
        return $get->toJson();
    }

    public function vepideTest() {
        $url = 'https://admin-dev.figgoapp.com';

        $data = [
            'username' => 'venezuela@dev.com',
            'password' => '123456',
            'companyPid' => '821041'
        ];
    
        $ch = curl_init($url . '/api/v1/admin/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        // Verifica si la solicitud fue exitosa
        if ($response === false) {
            $error = curl_error($ch);
            return response()->json(['error' => $error], 500); // Manejo de errores si la solicitud falla
        }
    
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($httpCode !== 200) {
            return response()->json(['error' => 'Error en la solicitud'], $httpCode); // Manejo de errores si la respuesta no es 200 OK
        }
    
        $responseData = json_decode($response, true);
        // $token = $responseData['token'];
    
        // Haz lo que necesites con el token
        return response()->json(['token' => $responseData], 200);
    }
}
