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
        Schema::create('fiche_presence_jours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('jours');
            $table->string('description');
            $table->foreignId('sallebase_id')->constrained('salle_bases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_presence_jours');
    }
};
