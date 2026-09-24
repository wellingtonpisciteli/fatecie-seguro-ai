<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Adiciona modalidade aos núcleos
        Schema::table('nucleos', function (Blueprint $table) {
            $table->enum('modalidade', ['presencial', 'ead'])
                ->after('nome')
                ->nullable();
        });

        // Transfere a modalidade dos cursos para seus respectivos núcleos
        DB::statement("
            UPDATE nucleos n
            INNER JOIN cursos c ON c.nucleo_id = n.id
            SET n.modalidade = c.modalidade
            WHERE n.modalidade IS NULL
        ");

        // Remove modalidade dos cursos
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn('modalidade');
        });

        // Remove modalidade_id dos seguros, caso exista
        if (Schema::hasColumn('seguros', 'modalidade_id')) {
            Schema::table('seguros', function (Blueprint $table) {
                $table->dropColumn('modalidade_id');
            });
        }
    }

    public function down(): void
    {
        // Recria modalidade nos cursos
        Schema::table('cursos', function (Blueprint $table) {
            $table->enum('modalidade', ['presencial', 'ead'])
                ->after('nome')
                ->nullable();
        });

        // Devolve a modalidade dos núcleos para os cursos
        DB::statement("
            UPDATE cursos c
            INNER JOIN nucleos n ON c.nucleo_id = n.id
            SET c.modalidade = n.modalidade
        ");

        // Remove modalidade dos núcleos
        Schema::table('nucleos', function (Blueprint $table) {
            $table->dropColumn('modalidade');
        });
    }
};

