<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Modificar el $Request
        $request->request->add(['userName' => Str::slug($request->userName)]);

        // Validación de datos
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'userName' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        // Equivalente a los insert into
        User::create([
            'name' => $request->name,
            'username' => $request->userName,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Autenticación de usuario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verificar si y solo si la autenticación es correcta se puede ingresar a la nueva vista
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            $user = Auth::user(); // Obtener el usuario autenticado
            return redirect()->route('post.index', ['user' => $user->username]); // Redirigir con el username
        }

        // Redireccionamiento al muro cuando se registra el usuario
        // return redirect()->route('post.index');
    }
}