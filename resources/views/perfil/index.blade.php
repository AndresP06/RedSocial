@extends('layouts.app')

@section('titulo')
    Edita perfil {{ auth()->user()->username }}
@endsection

@section('tituloPagina')
    Edita perfil {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store', ['username' => auth()->user()->username]) }}" method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="userName" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>
                    <input
                        type="text"
                        name="userName"
                        id="userName"
                        placeholder="Tu Nombre de usuario"
                        class="border p-3 w-full rounded-lg border-gray-300 @error('userName') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    >
                    @error('userName')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input
                        type="file"
                        name="imagen"
                        id="imagen"
                        class="border p-3 w-full rounded-lg border-gray-300"
                        accept=".jpg, .jpeg, .png"
                    >
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 mt-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection