<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NucleoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\SeguroController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboards
    Route::get('/dashboard/ead', [DashboardController::class, 'index'])
        ->middleware('modalidade:ead')
        ->name('dashboard.ead');

    Route::get('/dashboard/presencial', [DashboardController::class, 'index'])
        ->middleware('modalidade:presencial')
        ->name('dashboard.presencial');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Núcleos
    Route::resource('nucleos', NucleoController::class)
        ->only(['index', 'create', 'store', 'edit', 'update']);

    // Cursos
    Route::resource('cursos', CursoController::class)
        ->only(['index', 'create', 'store', 'edit', 'update']);

    // Alunos
    Route::resource('alunos', AlunoController::class)
        ->only(['index', 'create', 'store', 'edit', 'update']);

    // Seguros
    Route::resource('seguros', SeguroController::class)
        ->only(['index', 'create', 'store']);

    Route::post(
        '/seguros/{seguro}/confirmar-inclusao',
        [SeguroController::class, 'confirmarInclusao']
    )->name('seguros.confirmarInclusao');

    Route::post(
        '/seguros/{seguro}/registrar-retirada',
        [SeguroController::class, 'registrarRetirada']
    )->name('seguros.registrarRetirada');

    // Configurações
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])
        ->name('configuracoes.index');

    Route::put('/configuracoes', [ConfiguracaoController::class, 'atualizar'])
        ->name('configuracoes.atualizar');
});

require __DIR__.'/auth.php';