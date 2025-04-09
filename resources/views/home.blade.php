@extends('layouts.app')

@section('titulo')

    Este es el titulo inyectado a la plantilla de inicio

@endsection

@section('subtitulo')
    <h2>Este es el subtitulo delsitio</h2>

   
@endsection

@section('contenido')
    <x-listar-post :posts="$posts"/>
@endsection