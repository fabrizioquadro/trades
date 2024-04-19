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
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aluno');
            $table->unsignedBigInteger('id_corretora');
            $table->integer('nrConta');
            $table->string('nmConta');
            $table->text('dsConta')->nullable();
            $table->double('vlContaInc', 10, 2)->nullable();
            $table->string('moeda');
            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->foreign('id_corretora')->references('id')->on('corretoras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas');
    }
};
