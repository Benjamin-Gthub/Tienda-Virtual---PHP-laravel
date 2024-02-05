<?php

use App\Models\Curso;
use Illuminate\Http\Request;
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

Route::prefix('/admin')->group(function () {

    Route::get('/tipo_curso/search', [\App\Http\Controllers\Admin\TipoCursoController::class, 'search'])->name('tipo_curso.search');
    Route::resource('/tipo_curso', \App\Http\Controllers\Admin\TipoCursoController::class);

    // Route::resource('/curso', \App\Http\Controllers\Admin\CursoController::class);
});
