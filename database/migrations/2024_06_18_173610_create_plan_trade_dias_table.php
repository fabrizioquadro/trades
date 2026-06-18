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
        Schema::create('plan_trade_dias', function (Blueprint $table) {
            $table->id();
            $table->integer('planTrade_id');
            $table->date('dia');
            $table->string('diaSemana');
            $table->double('metaDiaAnterior', 10,2);
            $table->double('meta', 10,2);
            $table->double('realizar', 10,2);
            $table->double('riskMagagmentPlanejado', 10,2);
            $table->double('pontosContratoPlanejado',10,2);
            $table->integer('contratosPlanejado');
            $table->double('valorRealizado',10,2)->nullable();
            $table->double('custoRealizado',10,2)->nullable();
            $table->integer('nrTrades')->nullable();
            $table->integer('nrGains')->nullable();
            $table->integer('nrLoss')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_trade_dias');
    }
};
