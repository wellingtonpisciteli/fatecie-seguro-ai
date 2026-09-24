<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nucleo extends Model
{
    protected $fillable = [
        'nome',
        'modalidade',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }
}