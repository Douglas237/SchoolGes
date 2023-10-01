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
        Schema::create('trimestres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num_trimestre');
            $table->string('libeller');
            $table->date('DEBUT_COURS');
            $table->date('FIN_COURS');
            $table->date('DEBUT_EVALUATION');
            $table->date('FIN_EVALUATION');
            $table->date('DEBUT_RESULTAT');
            $table->date('FIN_RESULTAT');
            $table->date('Debut_Conger');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trimestres');
    }
};
