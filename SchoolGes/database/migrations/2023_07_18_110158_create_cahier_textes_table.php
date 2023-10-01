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
        Schema::create('cahier_textes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('periode_consommee');
    
            $table->integer('periode_restante');
            $table->string('status');
            $table->boolean('avance');
            $table->integer('retard');
            $table->text('description');
            $table->foreignId('salleClasse_id')->constrained('salle_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cahier_textes');
    }
};
