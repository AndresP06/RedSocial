<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // __invoke se ituliza como una fucnion que se llama automaticamente siempre
    public function __invoke()
    {
        $ids = auth()->user()->followings->pluck('id')->toArray();

        // Obtenemos los posts y también la info del usuario dueño de cada post
        $posts = Post::whereIn('user_id', $ids)->latest()
            ->with('user') // aquí Laravel incluirá los datos del usuario (incluido username)
            ->paginate(20);

        // dd($posts);

        return view('home', [
            'posts' => $posts
        ]);
    }

}
