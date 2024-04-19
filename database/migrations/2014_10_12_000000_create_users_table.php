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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('tipo');
            $table->string('password');
            $table->string('imagem')->nullable();
            $table->string('filtroTag')->nullable();
            $table->text('filtroAluno')->nullable();
            $table->string('filtroDtEntradaInc')->nullable();
            $table->string('filtroDtEntradaFn')->nullable();
            $table->string('filtroDtSaidaInc')->nullable();
            $table->string('filtroDtSaidaFn')->nullable();
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
            $table->string('filtroMoeda')->nullable();
            $table->string('filtroTipoCusto')->nullable();
            $table->string('filtroResultado')->nullable();
            $table->string('moedaBase')->default('BRL');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
