<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prontuario_alunos', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->string('aula');
            $table->date('dtAula');
            $table->time('hrInc');
            $table->time('hrFn');
            $table->string('presenca');
            $table->string('participacao');
            $table->string('permanencia');
            $table->string('atencao');
            $table->string('exercicios');
            $table->text('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prontuario_alunos');
    }
};
