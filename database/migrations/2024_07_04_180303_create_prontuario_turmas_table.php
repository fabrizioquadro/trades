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
        Schema::create('prontuario_turmas', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('aula');
            $table->date('dtAula');
            $table->time('hrInc', precision: 0);
            $table->time('hrFn', precision: 0);
            $table->text('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prontuario_turmas');
    }
};
