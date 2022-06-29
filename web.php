<?php

use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Consulta de tots els recursos
Route::get('libros', [LibroController::class, 'index'])->name('lista');
// Consulta d’un recurs
Route::get('libros/{libro}', [LibroController::class, 'show'])->name('consulta');
// Creació d'un recurs
Route::post('libros', [LibroController::class, 'store'])->name('alta');
// Modificació d'un recurs
Route::put('libros/{libro}', [LibroController::class, 'update'])->name('modificacion');
// Baixa d’un recurs
Route::delete('libros/{libro}', [LibroController::class, 'delete'])->name('borrado');