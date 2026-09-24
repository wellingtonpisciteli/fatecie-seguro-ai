<?php

namespace App\Http\Controllers;

use App\Models\Seguro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $hoje = Carbon::today();

        $modalidade = Auth::user()->modalidade;

        /*
        |--------------------------------------------------------------------------
        | Seguros da modalidade do usuário
        |--------------------------------------------------------------------------
        */

        $seguros = Seguro::whereHas('aluno.curso.nucleo', function ($query) use ($modalidade) {
            $query->where('modalidade', $modalidade);
        });

        /*
        |--------------------------------------------------------------------------
        | Indicadores
        |--------------------------------------------------------------------------
        */

        $totalSeguros = (clone $seguros)->count();

        $segurosAguardandoInclusao = (clone $seguros)
            ->where('status', 'aguardando_inclusao')
            ->count();

        $segurosAtivos = (clone $seguros)
            ->where('status', 'ativo')
            ->count();

        $segurosProximosVencimento = (clone $seguros)
            ->where('status', 'proximo_do_vencimento')
            ->count();

        $segurosVencidos = (clone $seguros)
            ->where('status', 'vencido')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Seguros que exigem atenção
        |--------------------------------------------------------------------------
        */

        $segurosAtencao = (clone $seguros)
            ->with('aluno')
            ->whereIn('status', [
                'proximo_do_vencimento',
                'vencido',
            ])
            ->orderByRaw("
                CASE
                    WHEN status = 'vencido' THEN 0
                    WHEN status = 'proximo_do_vencimento' THEN 1
                    ELSE 2
                END
            ")
            ->orderBy('data_fim')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Envia os dados para o dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'totalSeguros',
            'segurosAguardandoInclusao',
            'segurosAtivos',
            'segurosProximosVencimento',
            'segurosVencidos',
            'segurosAtencao',
            'hoje'
        ));
    }
}