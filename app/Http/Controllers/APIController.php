<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // obtener todas las categorias
    public function categorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }
}
