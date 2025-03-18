<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    //public function index(User $user)
    //{
        //dd($user);
        //return view('dashboard', [
          //  'user' => $user
        //]);
    //}

    public function store(Request $request)
    {
        

        //dd($request->remember);

        $validateData = $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);

        // autenticaciond e susuario
        if (!Auth::attempt($request->only('email', 'password'), $request->remember )) {
            // Redireccionar al susuario a la vista de ingreso
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

            // Obtener el usuario autenticado
        $user = Auth::user();

        // Redirigir a la URL con su username
        return redirect()->route('post.index', ['user' => $user->username]);

    }


}
