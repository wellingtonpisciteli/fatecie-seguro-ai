<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nucleo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    public function index()
    {
        $modalidade = Auth::user()->modalidade;

        $cursos = Curso::with('nucleo')
            ->whereHas('nucleo', function ($query) use ($modalidade) {
                $query->where('modalidade', $modalidade);
            })
            ->orderBy('nome')
            ->get();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $modalidade = Auth::user()->modalidade;

        $nucleos = Nucleo::where('ativo', true)
            ->where('modalidade', $modalidade)
            ->orderBy('nome')
            ->get();

        return view('cursos.create', compact('nucleos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nucleo_id' => [
                'required',
                'exists:nucleos,id',
            ],

            'nome' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $nucleo = Nucleo::findOrFail($dados['nucleo_id']);

        abort_unless(
            $nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        Curso::create([
            'nucleo_id' => $dados['nucleo_id'],
            'nome' => $dados['nome'],
            'ativo' => true,
        ]);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso cadastrado com sucesso.');
    }

    public function edit(Curso $curso)
    {
        abort_unless(
            $curso->nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        $modalidade = Auth::user()->modalidade;

        $nucleos = Nucleo::where('ativo', true)
            ->where('modalidade', $modalidade)
            ->orderBy('nome')
            ->get();

        return view('cursos.edit', compact('curso', 'nucleos'));
    }

    public function update(Request $request, Curso $curso)
    {
        abort_unless(
            $curso->nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        $dados = $request->validate([
            'nucleo_id' => [
                'required',
                'exists:nucleos,id',
            ],

            'nome' => [
                'required',
                'string',
                'max:255',
            ],

            'ativo' => [
                'required',
                'boolean',
            ],
        ]);

        $nucleo = Nucleo::findOrFail($dados['nucleo_id']);

        abort_unless(
            $nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        $curso->update($dados);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso atualizado com sucesso.');
    }
}

