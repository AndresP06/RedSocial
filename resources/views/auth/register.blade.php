@extends('layouts.app')

@section('titulo')
    Registro
@endsection

@section('tituloPagina')
    Registrate en InstaDev
@endsection


@section('contenido')
    <div class=" md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen Registro de ussuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('registro') }}" method="POST" novalidate>
                @csrf
                <div class="mb.5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                        type="text"
                        name="name" 
                        id="name" 
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg border-gray-300 @error('name')
                            border-red-500 
                        @enderror" value={{ old("name") }}
                    >
                    @error('name')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center " >{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb.5">
                    <label for="userName" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>
                    <input 
                        type="text"
                        name="userName" 
                        id="userName" 
                        placeholder="Tu Nombre de usuario"
                        class="border p-3 w-full rounded-lg border-gray-300 @error('name')
                            border-red-500 
                        @enderror" value={{ old("userName") }}
                    >
                    @error('userName')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center " >{{ $message }}</p>
                    @enderror
                </div>
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
                <div class="mb.5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir contraseña
                    </label>
                    <input 
                        type="password"
                        name="password_confirmation" 
                        id="password_confirmation" 
                        placeholder="Repetir contraseña"
                        class="border p-3 w-full rounded-lg border-gray-300 @error('name')
                            border-red-500 
                        @enderror" 
                    >
                    @error('password_confirmation')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center " >{{ $message }}</p>
                    @enderror
                </div>

                <input 
                type="submit" 
                value="Crear cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 mt-3 text-white rounded-lg">
            </form>

        </div>
    </div>
@endsection