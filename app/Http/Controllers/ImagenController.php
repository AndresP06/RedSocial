<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $imagen = $request->file('file');
                $nombreImagen = Str::uuid() . '.' . $imagen->extension();

                // Guardar la imagen en el disco 'public'
                $imagen->storeAs('imagenes', $nombreImagen, 'public');

                Log::info('Imagen guardada correctamente: ' . $nombreImagen);

                return response()->json([
                    'message' => 'Imagen guardada correctamente',
                    'imagen' => $nombreImagen
                ], 200);

            } catch (\Exception $e) {
                Log::error('Error al procesar la imagen: ' . $e->getMessage());
                return response()->json(['error' => 'Error al procesar la imagen'], 500);
            }
        } else {
            Log::error('No se recibió ningún archivo de imagen.');
            return response()->json(['error' => 'No se recibió ningún archivo de imagen'], 400);
        }
    }
}