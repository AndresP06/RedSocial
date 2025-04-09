<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']); // Aplicar middleware de autenticación
    }

    public function index(User $user)
    {

        // Consultando los posts del usuario
        $posts = Post::where('user_id', $user->id)->latest()->paginate(8); // Corregido

        dd($posts);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:100',
            'descripcion' => 'required|max:300',
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('post.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
    
        // Depuración: Verifica el valor de $post->image
        //dd($post->image);
    
        $imagen_path = public_path('storage/imagenes/' . $post->imagen);
    
        if (File::exists($imagen_path)) {
            //dd($imagen_path);
            unlink($imagen_path);
        }
    
        $post->delete();
    
        return redirect()->route('post.index', auth()->user()->username);
    }
}