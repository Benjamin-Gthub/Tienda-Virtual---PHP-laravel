<?php

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

Route::get('/admin', function () {
    return view('admin.admin');
})->middleware(['auth'])->name('admin');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/tipo_curso/search', [\App\Http\Controllers\Admin\TipoCursoController::class, 'search'])->name('tipo_curso.search');
        Route::resource('/tipo_curso', \App\Http\Controllers\Admin\TipoCursoController::class);

        Route::get('/rol/search', [\App\Http\Controllers\Admin\RolController::class, 'search'])->name('rol.search');
        Route::resource('/rol', \App\Http\Controllers\Admin\RolController::class)->except(['show']);

        Route::get('/persona/search', [\App\Http\Controllers\Admin\PersonaController::class, 'search'])->name('persona.search');
        Route::get('/persona/reporte/pdf', [\App\Http\Controllers\Admin\PersonaController::class, 'reportePdf'])->name('persona.reporte.pdf');
        Route::get('/persona/reporte/excel', [\App\Http\Controllers\Admin\PersonaController::class, 'reporteExcel'])->name('persona.reporte.excel');
        Route::resource('/persona', \App\Http\Controllers\Admin\PersonaController::class)->except(['show']);

        Route::get('/grupo/search', [\App\Http\Controllers\Admin\GrupoController::class, 'search'])->name('grupo.search');
        Route::resource('/grupo', \App\Http\Controllers\Admin\GrupoController::class)->except(['show']);

        Route::get('/matricula/search', [\App\Http\Controllers\Admin\MatriculaController::class, 'search'])->name('matricula.search');
        Route::resource('/matricula', \App\Http\Controllers\Admin\MatriculaController::class)->except(['show']);

        Route::get('/curso/search', [\App\Http\Controllers\Admin\CursoController::class, 'search'])->name('curso.search');
        Route::get('/curso/cargar-por-tipo/{tipo_curso_id}', [\App\Http\Controllers\Admin\CursoController::class, 'cargarPorTipo'])->name('curso.cargar_por_tipo');
        Route::resource('/curso', \App\Http\Controllers\Admin\CursoController::class)->except(['show']);
    });
});
