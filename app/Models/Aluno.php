<?php

namespace App\Models;

use App\Models\Seguro;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    protected $fillable = [
        'curso_id',
        'nome',
        'ra',
        'data_nascimento',
        'cpf',
        'data_inicial',
        'data_final',
        'status',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_inicial' => 'date',
        'data_final' => 'date',
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function seguros(): HasMany
    {
        return $this->hasMany(Seguro::class);
    }

    public function atualizarStatus(): void
    {
        $hoje = Carbon::today();

        // Estágio ainda não começou
        if ($hoje->lt($this->data_inicial)) {
            $this->status = 'aguardando';
        }

        // Estágio já terminou
        elseif ($hoje->gt($this->data_final)) {
            $this->status = 'encerrado';
        }

        // Estágio está vigente
        else {
            $this->status = 'vigente';
        }

        $this->save();
    }
}