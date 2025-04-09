<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Validación de comentarios
        $this->validate($request, [
            'comentario' => 'required|max:255', // Corregido 'comentarios' a 'comentario'
        ]);

        // Almacenar los datos
        Comentario::create([ // Corregido 'created' a 'create'
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // Imprimir mensaje
        return back()->with('mensaje', 'Comentario realizado con éxito');
    }
}