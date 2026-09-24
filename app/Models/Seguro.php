<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Configuracao;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seguro extends Model
{
    protected $fillable = [
        'aluno_id',
        'data_inclusao',
        'data_inicio',
        'data_fim',
        'data_retirada',
        'status',
        'observacao',
    ];

    protected $casts = [
        'data_inclusao' => 'date',
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'data_retirada' => 'date',
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function atualizarStatus(): void
    {
        // Seguro já retirado não deve sofrer alterações automáticas
        if ($this->status === 'retirado') {
            return;
        }

        // Seguro aguardando inclusão depende de ação manual
        if ($this->status === 'aguardando_inclusao') {
            return;
        }

        // Seguro aguardando retirada também depende de ação manual
        if ($this->status === 'aguardando_retirada') {
            return;
        }

        $hoje = Carbon::today();

        // Prazo já passou
        if ($hoje->gt($this->data_fim)) {
            $this->status = 'vencido';
            $this->save();

            return;
        }

        // Busca o prazo configurado no banco
        $prazoAlerta = (int) Configuracao::where(
            'chave',
            'prazo_alerta_vencimento'
        )->value('valor');

        $diasRestantes = $hoje->diffInDays($this->data_fim);

        // Seguro próximo do vencimento
        if ($diasRestantes <= $prazoAlerta) {
            $this->status = 'proximo_do_vencimento';
            $this->save();

            return;
        }

        // Seguro dentro da validade
        $this->status = 'ativo';
        $this->save();
    }
}