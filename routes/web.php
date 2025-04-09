<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;

//Route::get('/', function () {
//    return view('inicio');
//});
Route::get('/', HomeController::class)->name('home');

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
// ruta para ver una publicacion
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/post/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
// borrar publicacion
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post,destroy');
// agregar likes 
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('post.like.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('post.like.destroy');
// rutas para la edicion del perfil 
Route::get('/{username}/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/{username}/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');
// ruta para el seguimiento de ususarios 
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::post('/{user:username}', [PostController::class, 'index']);


