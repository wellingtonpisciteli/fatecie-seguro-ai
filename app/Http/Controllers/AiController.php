<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Seguro;
use App\Services\AiService;
use Illuminate\Http\Request;
use Throwable;

class AiController extends Controller
{
    public function perguntar(Request $request, AiService $ai)
    {
        $request->validate([
            'pergunta' => ['required', 'string', 'max:1000'],
        ]);

        try {
            $modalidade = $request->user()->modalidade;

            /*
            |--------------------------------------------------------------------------
            | Base de alunos da modalidade
            |--------------------------------------------------------------------------
            */

            $alunos = Aluno::query()
                ->whereHas('curso.nucleo', function ($query) use ($modalidade) {
                    $query->where('modalidade', $modalidade);
                });

            /*
            |--------------------------------------------------------------------------
            | Base de seguros da modalidade
            |--------------------------------------------------------------------------
            */

            $seguros = Seguro::query()
                ->whereHas('aluno.curso.nucleo', function ($query) use ($modalidade) {
                    $query->where('modalidade', $modalidade);
                });

            /*
            |--------------------------------------------------------------------------
            | Resumo calculado diretamente pelo banco
            |--------------------------------------------------------------------------
            */

            $contexto = [
                'modalidade_usuario' => $modalidade,

                'resumo_alunos' => [
                    'total' => (clone $alunos)->count(),

                    'vigentes' => (clone $alunos)
                        ->where('status', 'vigente')
                        ->count(),

                    'aguardando' => (clone $alunos)
                        ->where('status', 'aguardando')
                        ->count(),

                    'encerrados' => (clone $alunos)
                        ->where('status', 'encerrado')
                        ->count(),
                ],

                'resumo_seguros' => [
                    'total' => (clone $seguros)->count(),

                    'aguardando_inclusao' => (clone $seguros)
                        ->where('status', 'aguardando_inclusao')
                        ->count(),

                    'ativos' => (clone $seguros)
                        ->where('status', 'ativo')
                        ->count(),

                    'proximos_do_vencimento' => (clone $seguros)
                        ->where('status', 'proximo_do_vencimento')
                        ->count(),

                    'vencidos' => (clone $seguros)
                        ->where('status', 'vencido')
                        ->count(),

                    'aguardando_retirada' => (clone $seguros)
                        ->where('status', 'aguardando_retirada')
                        ->count(),

                    'retirados' => (clone $seguros)
                        ->where('status', 'retirado')
                        ->count(),
                ],
            ];

            /*
            |--------------------------------------------------------------------------
            | Pergunta para a IA
            |--------------------------------------------------------------------------
            */

            $resposta = $ai->perguntar(
                $request->string('pergunta')->toString(),
                $contexto
            );

            return response()->json([
                'sucesso' => true,
                'resposta' => $resposta,
            ]);

        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Não foi possível consultar o assistente.',
            ], 500);
        }
    }
}