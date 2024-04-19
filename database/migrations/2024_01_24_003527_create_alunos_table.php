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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nmAluno');
            $table->string('dsEmail')->unique();
            $table->string('dsSenha');
            $table->string('stAluno');
            $table->string('dsEndereco')->nullable();
            $table->string('nrEndereco')->nullable();
            $table->string('dsComplemento')->nullable();
            $table->string('dsBairro')->nullable();
            $table->string('nmCidade')->nullable();
            $table->string('dsEstado')->nullable();
            $table->string('nmPais')->nullable();
            $table->string('nrCep')->nullable();
            $table->string('nrTel')->nullable();
            $table->string('imagem')->nullable();
            $table->string('moedaBase')->nullable();
            $table->double('porcentagemPrejuizo',5,2)->nullable();
            $table->double('porcentagemLucro',5,2)->nullable();
            $table->date('dtEntradaInc')->nullable();
            $table->date('dtEntradaFn')->nullable();
            $table->date('dtSaidaInc')->nullable();
            $table->date('dtSaidaFn')->nullable();
            $table->string('filtroStatus')->nullable();
            $table->string('filtroTipoOperacao')->nullable();
            $table->string('filtroPais')->nullable();
            $table->string('filtroCorretora')->nullable();
            $table->string('filtroTipoConta')->nullable();
            $table->string('filtroConta')->nullable();
            $table->string('filtroAtivo')->nullable();
            $table->string('filtroTipoAtivo')->nullable();
            $table->string('filtroOperacao')->nullable();
            $table->string('filtroDirecao')->nullable();
            $table->string('filtroFase')->nullable();
            $table->string('filtroMoeda')->default('BRL');
            $table->string('filtroTipoCusto')->nullable();
            $table->string('filtroResultado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
