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
        Schema::create('contas_saques_depositos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_conta');
            $table->date('dtMovimento');
            $table->double('vlMovimento', 10, 2);
            $table->string('tpMovimento');
            $table->foreign('id_conta')->references('id')->on('contas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_saques_depositos');
    }
};
