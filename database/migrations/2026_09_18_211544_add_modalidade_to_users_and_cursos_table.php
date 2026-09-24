<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('modalidade', ['presencial', 'ead'])
                ->after('password');
        });

        Schema::table('cursos', function (Blueprint $table) {
            $table->enum('modalidade', ['presencial', 'ead'])
                ->after('nome');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('modalidade');
        });

        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn('modalidade');
        });
    }
};