<?php

namespace App\Http\Controllers;

use App\Models\Nucleo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NucleoController extends Controller
{
    public function index()
    {
        $modalidade = Auth::user()->modalidade;

        $nucleos = Nucleo::where('modalidade', $modalidade)
            ->orderBy('nome')
            ->get();

        return view('nucleos.index', compact('nucleos'));
    }

    public function create()
    {
        return view('nucleos.create');
    }

    public function store(Request $request)
    {
        $modalidade = Auth::user()->modalidade;

        $dados = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('nucleos', 'nome')
                    ->where(function ($query) use ($modalidade) {
                        $query->where('modalidade', $modalidade);
                    }),
            ],
        ]);

        Nucleo::create([
            'nome' => $dados['nome'],
            'modalidade' => $modalidade,
            'ativo' => true,
        ]);

        return redirect()
            ->route('nucleos.index')
            ->with('success', 'Núcleo cadastrado com sucesso.');
    }

    public function edit(Nucleo $nucleo)
    {
        abort_unless(
            $nucleo->modalidade === Auth::user()->modalidade,
            403
        );

        return view('nucleos.edit', compact('nucleo'));
    }

    public function update(Request $request, Nucleo $nucleo)
    {
        $modalidade = Auth::user()->modalidade;

        abort_unless(
            $nucleo->modalidade === $modalidade,
            403
        );

        $dados = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('nucleos', 'nome')
                    ->ignore($nucleo->id)
                    ->where(function ($query) use ($modalidade) {
                        $query->where('modalidade', $modalidade);
                    }),
            ],

            'ativo' => [
                'required',
                'boolean',
            ],
        ]);

        $nucleo->update($dados);

        return redirect()
            ->route('nucleos.index')
            ->with('success', 'Núcleo atualizado com sucesso.');
    }
}

