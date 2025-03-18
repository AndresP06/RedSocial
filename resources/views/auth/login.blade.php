@extends('layouts.app')

@section('titulo')
    Inicio sesion
@endsection

@section('tituloPagina')
    Inicia sesion en InstaDev
@endsection

@section('contenido')
    <div class=" md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login de ususario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                @if (session('mensaje'))
                    
                    <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center " >
                        {{ session('mensaje') }}
                    </p>
                    
                @endif

                <div class="mb.5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo
                    </label>
                    <input 
                        type="email"
                        name="email" 
                        id="email" 
                        placeholder="Tu correo"
                        class="border p-3 w-full rounded-lg border-gray-300 @error('name')
                            border-red-500 
                        @enderror" value={{ old("email") }}
                    >
                    @error('email')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center " >{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb.5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold ">
                        Contraseña
                    </label>
                    <input 
                        type="password"
                        name="password" 
                        id="password" 
                        placeholder="Tu Contraseña"
                        class="border p-3 w-full rounded-lg border-gray-300 @error('name')
                            border-red-500 
                        @enderror" 
                    >
                    @error('password')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center " >{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> <label class=" text-gray-500 text-sm" for="remember">Mantener mi sesión abierta</label>
                </div>
              
                <input 
                type="submit" 
                value="iniciar sesion"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 mt-3 text-white rounded-lg">
            </form>

        </div>
    </div>
@endsection