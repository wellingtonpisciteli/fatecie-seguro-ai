<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->restrictOnDelete();

            $table->date('data_inclusao')->nullable();

            $table->date('data_inicio');

            $table->date('data_fim');

            $table->date('data_retirada')->nullable();

            $table->string('status')
                ->default('aguardando_inclusao');

            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguros');
    }
};