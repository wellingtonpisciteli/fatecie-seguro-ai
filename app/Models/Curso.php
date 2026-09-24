<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $fillable = [
        'nucleo_id',
        'nome',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function nucleo(): BelongsTo
    {
        return $this->belongsTo(Nucleo::class);
    }

    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }
}