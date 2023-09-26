<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function lista() {
        return view('categorias.lista', [
            'categorias' => Categoria::all()
        ]);
    }

    public function store(Request $r) {
        Categoria::create($r->except('_token'));

        return '<script>alert("Añadido correctamente!");location.href="'.route('categorias').'"</script>';
    }
}
