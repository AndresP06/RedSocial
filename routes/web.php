<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('inicio');
});

//RUTAS PARA EL REGISTRO
Route::get('/Registro', [RegisterController::class, 'index'])->name('registro');
Route::post('/Registro', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

route::post('/logout', [LogoutController::class, 'store'])->name('logout')->middleware('auth');
//controlador para el ingreso de imagen 
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
//Crear
Route::post('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store'])->name('post.store');

Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::post('/{user:username}', [PostController::class, 'index']);


