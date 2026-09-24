<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Nucleo;
use App\Models\Seguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->query('busca');

        $modalidade = Auth::user()->modalidade;

        $alunos = Aluno::with('curso.nucleo')
            ->whereHas('curso.nucleo', function ($query) use ($modalidade) {
                $query->where('modalidade', $modalidade);
            })
            ->when($busca, function ($query) use ($busca) {

                $query->where(function ($query) use ($busca) {

                    $query->where('nome', 'like', "%{$busca}%")
                        ->orWhere('ra', 'like', "%{$busca}%");

                });

            })
            ->orderBy('nome')
            ->get();

        return view('alunos.index', compact(
            'alunos',
            'busca'
        ));
    }

    public function create()
    {
        $modalidade = Auth::user()->modalidade;

        $nucleos = Nucleo::where('ativo', true)
            ->where('modalidade', $modalidade)
            ->with([
                'cursos' => function ($query) {
                    $query->where('ativo', true)
                        ->orderBy('nome');
                }
            ])
            ->orderBy('nome')
            ->get();

        return view('alunos.create', compact('nucleos'));
    }

    public function store(Request $request)
    {
        $modalidade = Auth::user()->modalidade;

        $dados = $request->validate([
            'curso_id' => [
                'required',
                'exists:cursos,id',
            ],

            'nome' => [
                'required',
                'string',
                'max:255',
            ],

            'ra' => [
                'required',
                'string',
                'max:50',
            ],

            'data_nascimento' => [
                'nullable',
                'date',
            ],

            'cpf' => [
                'nullable',
                'string',
                'max:14',
            ],

            'data_inicial' => [
                'required',
                'date',
            ],

            'data_final' => [
                'required',
                'date',
                'after_or_equal:data_inicial',
            ],
        ]);

        $curso = Curso::where('id', $dados['curso_id'])
            ->whereHas('nucleo', function ($query) use ($modalidade) {
                $query->where('modalidade', $modalidade);
            })
            ->where('ativo', true)
            ->firstOrFail();

        DB::transaction(function () use ($dados, $curso) {

            /*
            |--------------------------------------------------------------------------
            | Cria o aluno
            |--------------------------------------------------------------------------
            */

            $aluno = Aluno::create([
                'curso_id' => $curso->id,
                'nome' => $dados['nome'],
                'ra' => $dados['ra'],
                'data_nascimento' => $dados['data_nascimento'] ?? null,
                'cpf' => $dados['cpf'] ?? null,
                'data_inicial' => $dados['data_inicial'],
                'data_final' => $dados['data_final'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Define o status conforme o período do estágio
            |--------------------------------------------------------------------------
            */

            $aluno->atualizarStatus();

            /*
            |--------------------------------------------------------------------------
            | Cria o seguro automaticamente
            |--------------------------------------------------------------------------
            */

            Seguro::firstOrCreate(
                [
                    'aluno_id' => $aluno->id,
                    'data_inicio' => $aluno->data_inicial,
                    'data_fim' => $aluno->data_final,
                ],
                [
                    'data_inclusao' => null,
                    'data_retirada' => null,
                    'status' => 'aguardando_inclusao',
                    'observacao' => null,
                ]
            );
        });

        return redirect()
            ->route('alunos.index')
            ->with(
                'success',
                'Aluno cadastrado com sucesso. Seguro criado como pendente de inclusão.'
            );
    }

    public function edit(Aluno $aluno)
    {
        $modalidade = Auth::user()->modalidade;

        abort_unless(
            $aluno->curso->nucleo->modalidade === $modalidade,
            403
        );

        $nucleos = Nucleo::where('ativo', true)
            ->where('modalidade', $modalidade)
            ->with([
                'cursos' => function ($query) {
                    $query->where('ativo', true)
                        ->orderBy('nome');
                }
            ])
            ->orderBy('nome')
            ->get();

        return view('alunos.edit', compact('aluno', 'nucleos'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $modalidade = Auth::user()->modalidade;

        abort_unless(
            $aluno->curso->nucleo->modalidade === $modalidade,
            403
        );

        $dados = $request->validate([
            'curso_id' => [
                'required',
                'exists:cursos,id',
            ],

            'nome' => [
                'required',
                'string',
                'max:255',
            ],

            'ra' => [
                'required',
                'string',
                'max:50',
            ],

            'data_nascimento' => [
                'nullable',
                'date',
            ],

            'cpf' => [
                'nullable',
                'string',
                'max:14',
            ],

            'data_inicial' => [
                'required',
                'date',
            ],

            'data_final' => [
                'required',
                'date',
                'after_or_equal:data_inicial',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Garante que o novo curso pertence à modalidade do usuário
        |--------------------------------------------------------------------------
        */

        $curso = Curso::where('id', $dados['curso_id'])
            ->whereHas('nucleo', function ($query) use ($modalidade) {
                $query->where('modalidade', $modalidade);
            })
            ->where('ativo', true)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Atualiza os dados do aluno
        |--------------------------------------------------------------------------
        */

        $aluno->update([
            'curso_id' => $curso->id,
            'nome' => $dados['nome'],
            'ra' => $dados['ra'],
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'cpf' => $dados['cpf'] ?? null,
            'data_inicial' => $dados['data_inicial'],
            'data_final' => $dados['data_final'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Recalcula o status conforme as novas datas
        |--------------------------------------------------------------------------
        */

        $aluno->atualizarStatus();

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno atualizado com sucesso.');
    }
}