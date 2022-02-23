<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {

        // leer la imagen
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');
        // rezise a la imagen
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 400);
        $imagen->save();

        // almacenar con Modelo
        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;

        $imagenDB->save();

        $resp = [
            'archivo' => $ruta_imagen,
        ];

        return response()->json($resp);
    }

    public function destroy(Request $request)
    {
        $imagen = $request->get('imagen');


        if (File::exists("storage/$imagen")) {
            // elimina imagen del servidor
            File::delete("storage/$imagen");

            // elimina imagen de la BD
            Imagen::where('ruta_imagen', $imagen)->delete();
            $resp = ['mensaje' => 'Imagen eliminada', 'imagen' => $imagen];
        }

        return response()->json($resp);
    }
}
