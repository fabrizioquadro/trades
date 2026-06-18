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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->dateTime('dtHrTicket');
            $table->text('dsAssunto');
            $table->text('dsTicket')->nullable();
            $table->string('stTicket');
            $table->string('stLidoAdm');
            $table->string('stLidoAluno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
