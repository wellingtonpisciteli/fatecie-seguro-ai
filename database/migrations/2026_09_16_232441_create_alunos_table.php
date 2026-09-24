<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curso_id')
                ->constrained('cursos')
                ->restrictOnDelete();

            $table->string('nome');
            $table->string('ra')->index();
            $table->date('data_nascimento')->nullable();
            $table->string('cpf', 14)->nullable();

            $table->date('data_inicial');
            $table->date('data_final');

            $table->string('status')->default('aguardando_inclusao');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};