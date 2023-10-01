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
        Schema::create('matiere_systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('admincirconscription_id')->constrained('admincirconscriptions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('typeenseignemt_id')->constrained('type_enseignements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('niveauenseignemt_id')->constrained('niveau_enseignements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cycleenseignemt_id')->constrained('cycle_enseignements')->onDelete('cascade')->onUpdate('cascade');
            $table->string('intitule_generale');
            $table->string('groupement');
            $table->string('domaine');
            $table->string('type');
            $table->string('classification');
            $table->integer('coefficient_generale');
            $table->integer('volumehoraire_system');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_systems');
    }
};
