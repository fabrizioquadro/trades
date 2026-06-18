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
        Schema::create('consistence_diamonds', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->integer('ano');
            $table->integer('mes');
            $table->integer('sem1Risk')->nullable();
            $table->integer('sem1Weeks')->nullable();
            $table->integer('sem1Months')->nullable();
            $table->integer('sem1GainLoss')->nullable();
            $table->integer('sem1TradePlan')->nullable();
            $table->integer('sem2Risk')->nullable();
            $table->integer('sem2Weeks')->nullable();
            $table->integer('sem2Months')->nullable();
            $table->integer('sem2GainLoss')->nullable();
            $table->integer('sem2TradePlan')->nullable();
            $table->integer('sem3Risk')->nullable();
            $table->integer('sem3Weeks')->nullable();
            $table->integer('sem3Months')->nullable();
            $table->integer('sem3GainLoss')->nullable();
            $table->integer('sem3TradePlan')->nullable();
            $table->integer('sem4Risk')->nullable();
            $table->integer('sem4Weeks')->nullable();
            $table->integer('sem4Months')->nullable();
            $table->integer('sem4GainLoss')->nullable();
            $table->integer('sem4TradePlan')->nullable();
            $table->integer('sem5Risk')->nullable();
            $table->integer('sem5Weeks')->nullable();
            $table->integer('sem5Months')->nullable();
            $table->integer('sem5GainLoss')->nullable();
            $table->integer('sem5TradePlan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consistence_diamonds');
    }
};
