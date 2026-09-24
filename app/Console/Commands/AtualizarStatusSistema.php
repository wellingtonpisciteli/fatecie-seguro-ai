<?php

namespace App\Console\Commands;

use App\Models\Aluno;
use App\Models\Seguro;
use Illuminate\Console\Command;

class AtualizarStatusSistema extends Command
{
    protected $signature = 'sistema:atualizar-status';

    protected $description = 'Atualiza automaticamente os status de alunos e seguros';

    public function handle(): int
    {
        /*
        |--------------------------------------------------------------------------
        | Atualiza alunos
        |--------------------------------------------------------------------------
        */

        $alunos = Aluno::all();

        $alunosAtualizados = 0;

        foreach ($alunos as $aluno) {

            $statusAnterior = $aluno->status;

            $aluno->atualizarStatus();

            $statusAtual = $aluno->fresh()->status;

            if ($statusAnterior !== $statusAtual) {
                $alunosAtualizados++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Atualiza seguros
        |--------------------------------------------------------------------------
        */

        $seguros = Seguro::all();

        $segurosAtualizados = 0;

        foreach ($seguros as $seguro) {

            $statusAnterior = $seguro->status;

            $seguro->atualizarStatus();

            $statusAtual = $seguro->fresh()->status;

            if ($statusAnterior !== $statusAtual) {
                $segurosAtualizados++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Resultado
        |--------------------------------------------------------------------------
        */

        $this->info(
            "Alunos: {$alunos->count()} verificados, {$alunosAtualizados} atualizados."
        );

        $this->info(
            "Seguros: {$seguros->count()} verificados, {$segurosAtualizados} atualizados."
        );

        return self::SUCCESS;
    }
}