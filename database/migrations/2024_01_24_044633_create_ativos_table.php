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
        Schema::create('ativos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('simbolo');
            $table->string('cqgSimbolo');
            $table->string('pais');
            $table->string('tipoAtivo');
            $table->string('exchange');
            $table->string('tamanhoContrato');
            $table->string('meses');
            $table->double('valor',10,2);
            $table->double('tick',10,2);
            $table->double('swing',10,2);
            $table->double('dayTrading',10,2);
            $table->string('moedaAtivo');
            $table->string('tipoCusto')->nullable();
            $table->string('stAtivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativos');
    }
};
