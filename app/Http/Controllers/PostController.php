<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Aplicar middleware de autenticación
    }

    public function index(User $user)
    {
        //dd($user);
        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {

        //dd(auth()->user());
        $this->validate($request, [
            'titulo' => 'required|max:100',
            'descripcion' => 'required|max:300',
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

     /*    otra manera de almacenar registros 
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */

        return redirect()->route('post.index', auth()->user()->username);
    }
}
