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
        Schema::create('emploi_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sallebase_id')->constrained('salle_bases')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('salleclasse_id')->constrained('salle_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('jourperiode_id')->constrained('jour_periodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('anneeacademiq_id')->constrained('annee_academiques')->onDelete('cascade')->onUpdate('cascade');
            $table->string('libelle')->nullable();
            $table->boolean('type')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_temps');
    }
};
