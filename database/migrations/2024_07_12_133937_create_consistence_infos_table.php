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
        Schema::create('consistence_infos', function (Blueprint $table) {
            $table->id();
            $table->text('riskReward')->nullable();
            $table->text('weeks')->nullable();
            $table->text('months')->nullable();
            $table->text('gainsLosses')->nullable();
            $table->text('trades')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consistence_infos');
    }
};
