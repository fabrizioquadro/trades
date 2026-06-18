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
        Schema::create('plan_trades', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->integer('nrPlan');
            $table->string('nmPlan');
            $table->string('moeda');
            $table->integer('id_ativo');
            $table->double('pontosContratoAtivo')->nullable();
            $table->double('garantiaContratoAtivo');
            $table->date('dtInc');
            $table->double('vlInc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_trades');
    }
};
