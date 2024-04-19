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
        Schema::create('matrizdecisao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aluno');
            $table->unsignedBigInteger('id_ativo');
            $table->dateTime('dtHrCadastro');
            $table->string('tLMensal')->nullable();
            $table->string('tLMensalFlag')->nullable();
            $table->string('tUTMensal')->nullable();
            $table->string('tUTMensalFlag')->nullable();
            $table->string('candleMensal')->nullable();
            $table->string('candleMensalFlag')->nullable();
            $table->string('conclusaoMensal')->nullable();
            $table->text('obsMensal')->nullable();
            $table->string('tLSemanal')->nullable();
            $table->string('tLSemanalFlag')->nullable();
            $table->string('tUTSemanal')->nullable();
            $table->string('tUTSemanalFlag')->nullable();
            $table->string('candleSemanal')->nullable();
            $table->string('candleSemanalFlag')->nullable();
            $table->string('conclusaoSemanal')->nullable();
            $table->text('obsSemanal')->nullable();
            $table->string('tLDiario')->nullable();
            $table->string('tLDiarioFlag')->nullable();
            $table->string('tUTDiario')->nullable();
            $table->string('tUTDiarioFlag')->nullable();
            $table->string('candleDiario')->nullable();
            $table->string('candleDiarioFlag')->nullable();
            $table->string('conclusaoDiario')->nullable();
            $table->text('obsDiario')->nullable();
            $table->string('tL60min')->nullable();
            $table->string('tL60minFlag')->nullable();
            $table->string('tUT60min')->nullable();
            $table->string('tUT60minFlag')->nullable();
            $table->string('candle60min')->nullable();
            $table->string('candle60minFlag')->nullable();
            $table->string('conclusao60min')->nullable();
            $table->text('obs60min')->nullable();
            $table->string('tL15min')->nullable();
            $table->string('tL15minFlag')->nullable();
            $table->string('tUT15min')->nullable();
            $table->string('tUT15minFlag')->nullable();
            $table->string('candle15min')->nullable();
            $table->string('candle15minFlag')->nullable();
            $table->string('conclusao15min')->nullable();
            $table->text('obs15min')->nullable();
            $table->string('tL5min')->nullable();
            $table->string('tL5minFlag')->nullable();
            $table->string('tUT5min')->nullable();
            $table->string('tUT5minFlag')->nullable();
            $table->string('candle5min')->nullable();
            $table->string('candle5minFlag')->nullable();
            $table->string('conclusao5min')->nullable();
            $table->text('obs5min')->nullable();
            $table->string('conclusaoTL')->nullable();
            $table->string('conclusaoTUT')->nullable();
            $table->string('conclusaoCandle')->nullable();
            $table->string('conclusaoConclusao')->nullable();
            $table->text('conclusaoObs')->nullable();
            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->foreign('id_ativo')->references('id')->on('ativos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrizdecisao');
    }
};
