<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\libroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\userController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\sancionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('layout');
});
*/
Route::get('/', function () {
    return view('redirect');
});
//Route::resource('libros',\App\Controllers\libroController::class);
Route::resource('libros', libroController::class);
//Route::get('/categorias', [categoriaController::class,'index']);
Route::resource('categorias', categoriaController::class);

Route::post('/BuscadorLibros',[LibroController::class, 'searchBooks']);

Route::get('/relatLibCat/{categoriaId}', [LibroController::class,'relatLibCat']);

Route::resource('usuarios', userController::class)->middleware('auth');

Route::resource('prestamos', PrestamoController::class)->middleware('auth');

Route::get('/sanciones', [sancionController::class,'index'])->middleware('auth');



Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
