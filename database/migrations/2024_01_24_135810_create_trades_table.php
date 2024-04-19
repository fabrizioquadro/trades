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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aluno');
            $table->integer('idOperacao');
            $table->dateTime('dtHrEntrada')->nullable();
            $table->dateTime('dtHrSaida')->nullable();
            $table->string('tempoOperacao')->nullable();
            $table->string('stOperacao')->nullable();
            $table->string('tipoOperacao')->nullable();
            $table->string('pais')->nullable();
            $table->unsignedBigInteger('id_corretora')->nullable();
            $table->string('tipoConta')->nullable();
            $table->unsignedBigInteger('id_conta')->nullable();
            $table->unsignedBigInteger('id_ativo')->nullable();
            $table->string('tipoAtivo')->nullable();
            $table->string('operacao')->nullable();
            $table->string('direcao')->nullable();
            $table->string('fase')->nullable();
            $table->double('quantidadeContratos')->nullable();
            $table->string('moeda')->nullable();
            $table->double('valorPontoContrato')->nullable();
            $table->string('tipoCusto')->nullable();
            $table->double('custoOperacaoEntrada')->nullable();
            $table->double('custoOperacaoSaida')->nullable();
            $table->double('precoEntrada')->nullable();
            $table->double('custoEntrada')->nullable();
            $table->double('precoSaida')->nullable();
            $table->double('custoSaida')->nullable();
            $table->double('resPosicaoPontos')->nullable();
            $table->double('resPosicaoFinanceiro')->nullable();
            $table->double('resContratoPontos')->nullable();
            $table->double('resContratoFinanceiro')->nullable();
            $table->double('variacaoEntradaSaida')->nullable();
            $table->double('resOperacaoCapital')->nullable();
            $table->string('gainOrLoss')->nullable();
            $table->string('saudeConta')->nullable();
            $table->integer('validador')->nullable();
            $table->double('vlSaldoConta', 10,2)->nullable();
            $table->double('resOperRefSaldoConta', 10,2)->nullable();
            $table->text('motivosEntrada')->nullable();
            $table->text('motivosSaida')->nullable();
            $table->double('cotacaoBRL')->nullable();
            $table->double('cotacaoUSD')->nullable();
            $table->double('cotacaoEUR')->nullable();
            $table->double('cotacaoGBP')->nullable();
            $table->double('cotacaoJPY')->nullable();
            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->foreign('id_corretora')->references('id')->on('corretoras');
            $table->foreign('id_conta')->references('id')->on('contas');
            $table->foreign('id_ativo')->references('id')->on('ativos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
