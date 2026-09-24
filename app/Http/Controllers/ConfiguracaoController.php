<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $prazoAlerta = Configuracao::where(
            'chave',
            'prazo_alerta_vencimento'
        )->value('valor');

        return view('configuracoes.index', compact('prazoAlerta'));
    }

    public function atualizar(Request $request)
    {
        $dados = $request->validate([
            'prazo_alerta_vencimento' => [
                'required',
                'integer',
                'min:1',
                'max:365',
            ],
        ]);

        Configuracao::updateOrCreate(
            ['chave' => 'prazo_alerta_vencimento'],
            ['valor' => $dados['prazo_alerta_vencimento']]
        );

        return redirect()
            ->route('configuracoes.index')
            ->with('success', 'Configuração atualizada com sucesso.');
    }
}