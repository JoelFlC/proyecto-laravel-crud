<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\BienvenidaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Articulo;

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

Route::get('/', [BienvenidaController::class, 'index']);


Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');

Route::get('/categoria/{id}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');


Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');


Route::get('/subcategoria', [SubcategoriaController::class, 'index'])->name('subcategoria.index');
Route::get('/subcategoria/categoria/{codigo_categoria}', [SubcategoriaController::class, 'index'])->name('subcategoria.filtrar');


Route::get('/articulo', [ArticuloController::class, 'index'])->name('articulo.index');
Route::get('/articulo/categoria/{codigo_categoria}', [ArticuloController::class, 'filtrarPorCategoria'])->name('articulo.filtrar.categoria');
Route::get('/articulo/subcategoria/{codigo_subcategoria}', [ArticuloController::class, 'filtrarPorSubcategoria'])->name('articulo.filtrar.subcategoria');

Route::get('/categoria/create', [CategoriaController::class, 'create'])->name('categoria.create');
Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
Route::get('/categoria/{id}/editar', [CategoriaController::class, 'editar'])->name('categoria.editar');
Route::put('/categoria/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
Route::resource('categoria', CategoriaController::class);




Route::resource('subcategoria', SubcategoriaController::class);
Route::get('subcategoria/filtrar/{codigo_categoria}', [SubcategoriaController::class, 'index'])->name('subcategoria.filtrar');




Route::resource('articulo', ArticuloController::class)->except(['show']);
Route::get('articulo/categoria/{codigo_categoria}',
    [ArticuloController::class,'filtrarPorCategoria'])
    ->name('articulo.filtrar.categoria');
Route::get('articulo/subcategoria/{codigo_subcategoria}',
    [ArticuloController::class,'filtrarPorSubcategoria'])
    ->name('articulo.filtrar.subcategoria');




