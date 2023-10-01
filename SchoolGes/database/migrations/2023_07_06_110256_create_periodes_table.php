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
        Schema::create('periodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('NUM_PERIODE');
            $table->enum('libeller', ['Periode1', 'Periode2', 'Periode3', 'Periode4', 'Periode5', 'Periode6', 'Periode7', 'Periode8', 'Periode9', 'Periode10','Periode-1','Periode-2','Periode-3']);
            $table->time('HEURE_DEBUT');
            $table->time('HEURE_FIN');
            $table->integer('valeur_reelle');
            $table->boolean('pause');
            $table->text('description');
            $table->foreignId('etablissement_id')->constrained('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
};
