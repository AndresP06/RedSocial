<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PerfilController extends Controller
{
    public function index()
    {
        $this->middleware('auth');
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Modificar el $Request
        $request->request->add(['username' => Str::slug($request->userName)]);

        $this->validate($request, [
            'userName' => 'required|unique:users,userName,' . auth()->user()->id . '|min:3|max:30', // Regla de validación corregida
        ]);

        if ($request->hasFile('imagen')) {
            try {
                $imagen = $request->file('imagen');
                $nombreImagen = Str::uuid() . '.' . $imagen->extension();

                // Guardar la imagen en el disco 'public'
                $imagen->storeAs('imagenes/perfil', $nombreImagen, 'public');

                Log::info('Imagen guardada correctamente: ' . $nombreImagen);

              
            } catch (\Exception $e) {
                Log::error('Error al procesar la imagen: ' . $e->getMessage());
                return response()->json(['error' => 'Error al procesar la imagen'], 500);
            }
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar el usuario
        return redirect()->route('post.index', ['user' => $usuario->username]);
    }
}