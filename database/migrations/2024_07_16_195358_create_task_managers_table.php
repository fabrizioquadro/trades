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
        Schema::create('task_managers', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->date('dtTask');
            $table->string('stTask'); // aqui vai finalizado ou não finalizado
            $table->text('dsTask')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_managers');
    }
};
