<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('name'));


        //¿como modificar el $Request?
        $request->request->add(['userName' => Str::slug($request->userName)]);


        // Validacion de datos

        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'userName' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        // equivalente a los insert into
        User::create([
            'name' => $request->name,
            'username' => $request->userName,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //autenticacion de usuario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // verificar si y solo si al autenticacion es correcta se peude ingresar a la neuva vista 
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->route('post.index'); // O la ruta que necesites
        }

        // Redireccionamiento al muro cuando se registra el ususario
        //return redirect()->route('post.index');

    }
}
