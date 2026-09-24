<?php

namespace App\Http\Controllers;

use App\Models\Seguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguroController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $busca = $request->query('busca');

        $modalidade = Auth::user()->modalidade;

        /*
        |--------------------------------------------------------------------------
        | Consulta base por modalidade
        |--------------------------------------------------------------------------
        */

        $seguros = Seguro::whereHas('aluno.curso.nucleo', function ($query) use ($modalidade) {
            $query->where('modalidade', $modalidade);
        });

        /*
        |--------------------------------------------------------------------------
        | Indicadores gerais
        |--------------------------------------------------------------------------
        */

        $totalSeguros = (clone $seguros)->count();

        $segurosAguardandoInclusao = (clone $seguros)
            ->where('status', 'aguardando_inclusao')
            ->count();

        $segurosAtivos = (clone $seguros)
            ->where('status', 'ativo')
            ->count();

        $segurosProximos = (clone $seguros)
            ->where('status', 'proximo_do_vencimento')
            ->count();

        $segurosVencidos = (clone $seguros)
            ->where('status', 'vencido')
            ->count();

        $segurosAguardandoRetirada = (clone $seguros)
            ->where('status', 'aguardando_retirada')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Lista filtrada
        |--------------------------------------------------------------------------
        */

        $seguros = (clone $seguros)
            ->with([
                'aluno.curso.nucleo',
            ])
            ->when(
                $status,
                function ($query) use ($status) {

                    if (is_array($status)) {
                        $query->whereIn('status', $status);
                    } else {
                        $query->where('status', $status);
                    }

                }
            )
            ->when(
                $busca,
                function ($query) use ($busca) {

                    $query->whereHas('aluno', function ($query) use ($busca) {

                        $query->where('nome', 'like', "%{$busca}%")
                            ->orWhere('ra', 'like', "%{$busca}%");

                    });

                }
            )
            ->latest()
            ->get();

        return view('seguros.index', compact(
            'seguros',
            'status',
            'busca',
            'totalSeguros',
            'segurosAguardandoInclusao',
            'segurosAtivos',
            'segurosProximos',
            'segurosVencidos',
            'segurosAguardandoRetirada'
        ));
    }

    public function confirmarInclusao(Seguro $seguro)
    {
        /*
        |--------------------------------------------------------------------------
        | Garante que o seguro pertence à modalidade do usuário
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $seguro->aluno->curso->nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        if ($seguro->status !== 'aguardando_inclusao') {
            return back()->with(
                'error',
                'Este seguro não está aguardando inclusão.'
            );
        }

        $seguro->update([
            'status' => 'ativo',
            'data_inclusao' => now()->toDateString(),
        ]);

        $seguro->atualizarStatus();

        return back()->with(
            'success',
            'Inclusão do seguro registrada com sucesso.'
        );
    }

    public function registrarRetirada(Seguro $seguro)
    {
        /*
        |--------------------------------------------------------------------------
        | Garante que o seguro pertence à modalidade do usuário
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $seguro->aluno->curso->nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        if (!in_array($seguro->status, [
            'ativo',
            'proximo_do_vencimento',
            'vencido',
            'aguardando_retirada',
        ])) {
            return back()->with(
                'error',
                'Este seguro não pode ser retirado neste momento.'
            );
        }

        $seguro->update([
            'status' => 'retirado',
            'data_retirada' => now()->toDateString(),
        ]);

        return back()->with(
            'success',
            'Retirada do seguro registrada com sucesso.'
        );
    }
}
