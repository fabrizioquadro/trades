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
            $table->text('filtroTrades')->nullable();
            $table->integer('plan1AtivoBase')->nullable();
            $table->double('plan1MetaGanhoDiario',10,2)->nullable();
            $table->double('plan1PontosContratoAtivo',10,2)->nullable();
            $table->integer('plan1MetaMaximaPontos')->nullable();
            $table->double('plan1GarantiaContrato',10,2)->nullable();
            $table->integer('plan1FatorCorrecaoGarantia')->nullable();
            $table->double('plan1LimiteGanhoDia',10,2)->nullable();
            $table->integer('plan1MaximoContratos')->nullable();
            $table->integer('plan2AtivoBase')->nullable();
            $table->double('plan2MetaGanhoDiario',10,2)->nullable();
            $table->double('plan2PontosContratoAtivo',10,2)->nullable();
            $table->integer('plan2MetaMaximaPontos')->nullable();
            $table->double('plan2GarantiaContrato',10,2)->nullable();
            $table->integer('plan2FatorCorrecaoGarantia')->nullable();
            $table->double('plan2LimiteGanhoDia',10,2)->nullable();
            $table->integer('plan2MaximoContratos')->nullable();
            $table->integer('plan3AtivoBase')->nullable();
            $table->double('plan3MetaGanhoDiario',10,2)->nullable();
            $table->double('plan3PontosContratoAtivo',10,2)->nullable();
            $table->integer('plan3MetaMaximaPontos')->nullable();
            $table->double('plan3GarantiaContrato',10,2)->nullable();
            $table->integer('plan3FatorCorrecaoGarantia')->nullable();
            $table->double('plan3LimiteGanhoDia',10,2)->nullable();
            $table->integer('plan3MaximoContratos')->nullable();
            $table->integer('plan4AtivoBase')->nullable();
            $table->double('plan4MetaGanhoDiario',10,2)->nullable();
            $table->double('plan4PontosContratoAtivo',10,2)->nullable();
            $table->integer('plan4MetaMaximaPontos')->nullable();
            $table->double('plan4GarantiaContrato',10,2)->nullable();
            $table->integer('plan4FatorCorrecaoGarantia')->nullable();
            $table->double('plan4LimiteGanhoDia',10,2)->nullable();
            $table->integer('plan4MaximoContratos')->nullable();
            $table->integer('plan5AtivoBase')->nullable();
            $table->double('plan5MetaGanhoDiario',10,2)->nullable();
            $table->double('plan5PontosContratoAtivo',10,2)->nullable();
            $table->integer('plan5MetaMaximaPontos')->nullable();
            $table->double('plan5GarantiaContrato',10,2)->nullable();
            $table->integer('plan5FatorCorrecaoGarantia')->nullable();
            $table->double('plan5LimiteGanhoDia',10,2)->nullable();
            $table->integer('plan5MaximoContratos')->nullable();
            $table->boolean('aceitePrivacyPolice')->default(0);
            $table->dateTime('dataPrivacyPolice')->nullable();
            $table->boolean('aceiteCookiesPolice')->default(0);
            $table->dateTime('dataCookiesPolice')->nullable();
            $table->boolean('aceiteTermsAndConditions')->default(0);
            $table->dateTime('dataTermsAndConditions')->nullable();
            $table->boolean('aceiteNonDisclosure')->default(0);
            $table->dateTime('dataNonDisclosure')->nullable();
            $table->boolean('aceiteRiskWarning')->default(0);
            $table->dateTime('dataRiskWarning')->nullable();
            $table->string('userTradingView')->nullable();
            $table->boolean('setarNovaSenha')->default(0);
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
