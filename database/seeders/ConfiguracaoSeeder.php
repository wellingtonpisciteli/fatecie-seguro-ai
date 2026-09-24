<?php

namespace Database\Seeders;

use App\Models\Configuracao;
use Illuminate\Database\Seeder;

class ConfiguracaoSeeder extends Seeder
{
    public function run(): void
    {
        Configuracao::updateOrCreate(
            ['chave' => 'prazo_alerta_vencimento'],
            ['valor' => '30']
        );
    }
}